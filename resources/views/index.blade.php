@extends('layout.main')

@section('content')
<div>

  <aside id="colorlib-hero">
    <div class="flexslider">
      <ul class="slides">
         <li style="background-image: url(images/img_bg_1.jpg);">
           <div class="overlay"></div>
           <div class="container-fluid">
             <div class="row">
               <div class="col-sm-6 offset-sm-3 text-center slider-text">
                 <div class="slider-text-inner">
                   <div class="desc">
                     <h1 class="head-1">Men's</h1>
                     <h2 class="head-2">Shoes</h2>
                     <h2 class="head-3">Collection</h2>
                     <p class="category"><span>New trending shoes</span></p>
                     <p><a href="#" class="btn btn-primary">Shop Collection</a></p>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </li>
         <li style="background-image: url(images/img_bg_2.jpg);">
           <div class="overlay"></div>
           <div class="container-fluid">
             <div class="row">
               <div class="col-sm-6 offset-sm-3 text-center slider-text">
                 <div class="slider-text-inner">
                   <div class="desc">
                     <h1 class="head-1">Huge</h1>
                     <h2 class="head-2">Sale</h2>
                     <h2 class="head-3"><strong class="font-weight-bold">50%</strong> Off</h2>
                     <p class="category"><span>Big sale sandals</span></p>
                     <p><a href="#" class="btn btn-primary">Shop Collection</a></p>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </li>
         <li style="background-image: url(images/img_bg_3.jpg);">
           <div class="overlay"></div>
           <div class="container-fluid">
             <div class="row">
               <div class="col-sm-6 offset-sm-3 text-center slider-text">
                 <div class="slider-text-inner">
                   <div class="desc">
                     <h1 class="head-1">New</h1>
                     <h2 class="head-2">Arrival</h2>
                     <h2 class="head-3">up to <strong class="font-weight-bold">30%</strong> off</h2>
                     <p class="category"><span>New stylish shoes for men</span></p>
                     <p><a href="#" class="btn btn-primary">Shop Collection</a></p>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </li>
        </ul>
      </div>
  </aside>

  <div class="colorlib-product">
    <div class="container">
      
      @if (count($bestSellers) != 0)
        <div class="row">
          <div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
            <h2>Best Sellers</h2>
          </div>
        </div>

        <div class="row row-pb-md">
          @foreach ($bestSellers as $item)
            <div class="col-lg-3 mb-4 text-center">
              <div class="product-entry border">
                <a href="{{url("detail/$item[id]")}}" class="prod-img">
                  <img src="{{$item['image_source']}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
                </a>
                <div class="desc">
                  <h2><a href="{{url("detail/$item[id]")}}">{{$item['title']}}</a></h2>
                  <span class="price">${{$item['price']}}</span>
                  <button onclick="addToCart({{$item['id']}}, 1)" class="btn btn-primary btn-addtocart"><i class="icon-shopping-cart"></i></button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
      
      @if (count($newProducts) != 0)
        <div class="row">
          <div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
            <h2>New Products</h2>
          </div>
        </div>

        <div class="row row-pb-md">
          @foreach ($newProducts as $item)
            <div class="col-lg-3 mb-4 text-center">
              <div class="product-entry border">
                <a href="{{url("detail/$item[id]")}}" class="prod-img">
                  <img src="{{$item['image_source']}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
                </a>
                <div class="desc">
                  <h2><a href="{{url("detail/$item[id]")}}">{{$item['title']}}</a></h2>
                  <span class="price">${{$item['price']}}</span>
                  <button onclick="addToCart({{$item['id']}}, 1)" class="btn btn-primary btn-addtocart"><i class="icon-shopping-cart"></i></button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
  
      <div class="row">
        <div class="col-md-12 text-center">
          <p><a href="#" class="btn btn-primary btn-lg">Shop All Products</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection