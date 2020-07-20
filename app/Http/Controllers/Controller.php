<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Mail\MailBookingNotify;
use Illuminate\Support\Facades\Mail;

//Auth
use Illuminate\Support\Facades\Auth;
//Model
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductGroup;
use Modules\Product\Entities\Brand;
use Modules\Theme\Entities\Banner;
use Modules\Booking\Entities\MethodShip;
use Modules\Booking\Entities\MethodPayment;
use Modules\Booking\Entities\Order;
use Modules\Booking\Entities\OrderDetail;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $this->pageName = 'FASHION Interesting';
        Category::fixTree();
        $this->categories = Category::get()->toTree();
        \View::share([
            'categories'=>$this->categories,
            'pageName'=> $this->pageName . ' - ' . $this->pageName
        ]);
    }

    public function index(){
        $banners = Banner::orderBy('index', 'asc')->limit(3)->get();
        $groups = ProductGroup::orderBy('index', 'asc')->limit(5)->get();
        $collections = [];
        foreach ($groups as $col) {
            $products = Product::where('group_id', $col->id)->limit(Config('product.limit'))->get();
            array_push($collections, [$col->index=>$products]);
        }
        
        return response()->view('index', [
            'banners'=>$banners,
            'groups'=>$groups,
            'collections'=>$collections,
        ]);
    }

    public function search(Request $request){
        $keyword = $request->keyword;
        $other = ['title'=> 'Brand', 'children'=>Brand::get()];
        $products = Product::where('title', "like", "%$keyword%")
            ->paginate(Config('product.limit'));
        $object = [
            "title" => "Search",
            "image_source" => 'images/cover-img-1.jpg',
        ];
        $siblings = Category::where('parent_id', ">", "0")->get();

        return View('collection', 
            [
                'pageName'=> $this->pageName . ' - Search page',
                'object'=>$object,
                'other' => $other,
                'products'=>$products,
                'siblings' => $siblings
            ]);
    }
    
    public function pages($slug){

        $category = Category::where('slug', $slug)->first();
        $group = ProductGroup::where('slug', $slug)->first();
        $brand = Brand::where('slug', $slug)->first();
        $product = null;

        $categorySlug = $this->getSlug($category);
        $groupSlug = $this->getSlug($group);
        $brandSlug = $this->getSlug($brand);
        $productSlug = null;

        if (empty($category) && empty($group) && empty($brand)) {
            $product = Product::where('slug', $slug)->first();
            $productSlug = $this->getSlug($product);
        }

        switch ($slug) {
            case $categorySlug:
                return $this->viewCategory($category);
                break;
            case $groupSlug:
                return $this->viewGroup($group);
                break;
            case $brandSlug:
                return $this->viewBrand($brand);
                break;

            case $productSlug:
                return $this->viewProduct($product);
                break;
            
            default:
                return view('error');
                break;
        }
    }

    private function getSlug($model){
        return optional($model)->slug;
    }

    private function viewBrand($brand){
        $id = $brand->id;
        $siblings = Brand::where('id', '!=',  $id)->get();
        $other = ['title'=> 'Collection', 'children'=>ProductGroup::get()];
        $products = Product::where('brand_id', $id)
            ->paginate(Config('product.limit'));
        return View('collection', 
            [
                'pageName'=> $this->pageName . ' - ' . $brand->title,
                'object'=>$brand,
                'other' => $other,
                'siblings'=>$siblings,
                'products'=>$products,
            ]);
    }

    private function viewGroup($group){
        $id = $group->id;
        $siblings = ProductGroup::where('id', '!=',  $id)->get();
        $other = ['title'=> 'Brand', 'children'=>Brand::get()];
        $products = Product::where('group_id', $id)
            ->paginate(Config('product.limit'));
        return View('collection', 
            [
                'pageName'=> $this->pageName . ' - ' . $group->title,
                'object'=>$group,
                'other' => $other,
                'siblings'=>$siblings,
                'products'=>$products,
            ]);
    }

    private function viewCategory($category){
        $id = $category->id;
        $siblings = $category->siblings()->get();
        $children = Category::descendantsOf($id);
        $other = ['title'=> 'Brand', 'children'=>Brand::get()];
        $arr = [$id];
        foreach ($children as $child) {
            array_push($arr, $child->id);
        }
        $products = Product::whereIn('category_id', $arr)
            ->paginate(Config('product.limit'));

        $active = '';
        $parent = Category::where('id', $category->parent_id)->first();
        if(empty($parent)){
            $active = $category->slug;
        }
        else
            $active = $parent->slug;

        return View('collection', 
            [
                'active' => $active,
                'pageName'=> $this->pageName . ' - ' . $category->title,
                'object'=>$category,
                'other' => $other,
                'siblings'=>$siblings,
                'products'=>$products,
            ]);
    }

    private function viewProduct($product){
        $gallery = $product->gallery()->get();
        return response()->view('detail', [
            'pageName'=> $this->pageName . ' - ' . $product->title,
            'product'=>$product,
            'gallery'=>$gallery
        ]);;
    }

    public function cart(){
        return response()->view('cart', ['active'=>'cart']);;
    }

    public function cartCheckout(){
        return response()->view('cart-checkout', ['active'=>'cart']);;
    }

    public function cartComplete(Request $request){
        $name = $request->name;
        $address = $request->address;
        $email = $request->email;
        $note = $request->note;
        $phone = $request->phone;
        $products = array_map('intval', explode(',', $request->products));
        $quantities = array_map('intval', explode(',', $request->quantities));

        $user = User::where('email', $email)->first();
        if($user == null){
            $user                 = new User();
            $user->name           = $name;
            $user->email          = $email;
            $user->password       = bcrypt($email);
            $user->roles_id       = 3;
            $user->save();
        }

        $total = 0;
        for ($i=0; $i < count($products); $i++) { 
            $total += Product::find($products[$i])->price * $quantities[$i];
        }
        
        $order = new Order();
        $order->name = $name;
        $order->phone = $phone;
        $order->email = $email;
        $order->address = $address;
        $order->note = $note;
        $order->ship_id = 1;
        $order->total = $total;
        $order->status = 0;
        $order->payment_id = 1;

        $order->save();

        $id = $order->id;
        $details = [];
        for ($i=0; $i < count($products) ; $i++) { 
            array_push($details, [
                'order_id' => $id,
                'product_id' => $products[$i],
                'quantity' => $quantities[$i]
            ]);
        }
        OrderDetail::insert($details);

        try {
            Mail::to($user)->send(new MailBookingNotify($user));
            if (Mail::failures()) {
                return view('error');
            }
        } catch (\Throwable $th) {
            return view('error');
        }

        
        return redirect('/cart.html/complete');
    }

    public function complete(){
        return response()->view('cart-complete', ['active'=>'cart']);
    }

    public function cartProducts(Request $request){
        if(!isset($request->products) || !isset($request->quantities))
            return;

        $products = [];
        foreach ($request->products as $id) {
            array_push($products, Product::find($id));
        }
        return response()->view('contents.cart-content', [
            'quantities'=>$request->quantities,
            'products'=>$products
        ]);;
    }
    public function cartPriceTotal(Request $request){
        if(!isset($request->products) || !isset($request->quantities))
            return;

        $total = 0;
        for ($i=0; $i < count($request->products); $i++) { 
            $total += Product::find($request->products[$i])->price * $request->quantities[$i];
        }
        return response()->view('contents.cart-price-total', [
            'total'=>$total,
        ]);;
    }
    public function cartRelated(Request $request){
        if(!isset($request->products) || !isset($request->quantities))
            return ;

        $categories = [];
        foreach ($request->products as $id) {
            array_push($categories, Product::find($id)->category_id);
        }
        $products = Product::whereIn('category_id', $categories)->inRandomOrder()->limit(Config('product.related'))->get();
        return response()->view('contents.cart-related', [
            'products'=>$products
        ]);;
    }
    public function carRemove(Request $request){
        $id = (int) $request->id;
        Product::delete($id);
        return response()->json([
            'status'=> 1
        ], 200);
    }
}
