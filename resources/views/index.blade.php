@extends('layout.main')

@section('content')
<div>

  <aside id="colorlib-hero">
    <div class="flexslider">
      <ul class="slides">
         @foreach ($banners as $item)
          <li style="background-image: url({{$item['image_source']}});">
            <div class="overlay"></div>
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6 offset-sm-3 text-center slider-text">
                  <div class="slider-text-inner">
                    <div class="desc">
                      <h1 class="head-1">{{$item['slogan']}}</h1>
                      <h2 class="head-3">{{$item['slogan']}}</h2>
                      <h2 class="head-2">{{$item['slogan']}}</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
         @endforeach
        </ul>
      </div>
  </aside>

  <div class="colorlib-product">
    <div class="container">

      @php
          $i = -1;
      @endphp
      @foreach ($collections as $col)
        @php
            $i++;
        @endphp
        @if (count($col[$groups[$i]['index']]) != 0)
          <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
              <h2>{{$groups[$i]['title']}}</h2>
            </div>
          </div>

          <div class="row row-pb-md">
            @foreach ($col[$groups[$i]['index']] as $item)
              <div class="col-lg-3 mb-4 text-center">
                <div class="product-entry border">
                  <a href="{{url("$item[slug]")}}.html" class="prod-img">
                    <img src="{{url("$item[image_source]")}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
                  </a>
                  <div class="desc">
                    <h2><a href="{{url("$item[slug]")}}.html">{{$item['title']}}</a></h2>
                    <span class="price">${{$item['price']}}</span>
                    <button onclick="addToCart({{$item['id']}}, 1)" class="btn btn-primary btn-addtocart"><i class="icon-shopping-cart"></i></button>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      @endforeach
  
      <div class="row">
        <div class="col-md-12 text-center">
          <p><a href="#" class="btn btn-light btn-lg">Shop All Products</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection