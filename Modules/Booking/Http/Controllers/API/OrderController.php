<?php

namespace Modules\Booking\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Entities\Order;
use Modules\Booking\Entities\OrderDetail;
use Modules\Product\Entities\Product;
use Modules\Booking\Transformers\OrderResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('booking::index');
    }

    public function detail(Request $request){
        try {            
            $order = Order::findOrFail($id);
            return response()->json([
                'status'=> 1,
                'data'=> new OrderResource($order)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=> 0,
                'msg'=> $th->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $address = $request->address;
            $note = $request->note;
            $phone = $request->phone;
            $products = array_map('intval', explode(',', $request->products));
            $quantities = array_map('intval', explode(',', $request->quantities));
            
            $total = 0;
            for ($i=0; $i < count($products); $i++) { 
                $total += Product::find($products[$i])->price * $quantities[$i];
            }
            
            $order = new Order();
            $order->name = $user->name;
            $order->phone = $phone;
            $order->email = $user->email;
            $order->address = $address;
            $order->note = $note;
            $order->ship_id = 1;
            $order->total = $total;
            $order->status = 0;
            $order->payment_id = 1;
            $order->user_id = $user->id;

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
            return response()->json([
                'status'=> 1,
                'data'=> new OrderResource($order)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=> 0,
                'msg'=> $th->getMessage()
            ]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('booking::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
