@extends('layout.main')

@section('content')
<div>

    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread">
                        <span><a href="{{url('/')}}">Home</a></span>
                        @if ($parent != null)
                            / <span>{{$parent['title']}}</span>
                        @endif
                        / <span>{{$category['title']}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="breadcrumbs-two">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs-img" style="background-image: url({{url('images/cover-img-1.jpg')}});">
                        <h2>{{$category['title']}}</h2>
                    </div>
                    <div class="menu text-center">
                        <p>
                            @foreach ($siblings as $sibling)
                                <a href="{{url("category/$sibling[id]")}}">{{$sibling['title']}}</a>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <div class="colorlib-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-xl-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="side border mb-1">
                            <h3>Brand</h3>
                            <ul>
                                <li><a href="#">Nike</a></li>
                                <li><a href="#">Adidas</a></li>
                                <li><a href="#">Merrel</a></li>
                                <li><a href="#">Gucci</a></li>
                                <li><a href="#">Skechers</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="side border mb-1">
                            <h3>Size/Width</h3>
                            <div class="block-26 mb-2">
                                <h4>Size</h4>
                           <ul>
                              <li><a href="#">7</a></li>
                              <li><a href="#">7.5</a></li>
                              <li><a href="#">8</a></li>
                              <li><a href="#">8.5</a></li>
                              <li><a href="#">9</a></li>
                              <li><a href="#">9.5</a></li>
                              <li><a href="#">10</a></li>
                              <li><a href="#">10.5</a></li>
                              <li><a href="#">11</a></li>
                              <li><a href="#">11.5</a></li>
                              <li><a href="#">12</a></li>
                              <li><a href="#">12.5</a></li>
                              <li><a href="#">13</a></li>
                              <li><a href="#">13.5</a></li>
                              <li><a href="#">14</a></li>
                           </ul>
                        </div>
                        <div class="block-26">
                                <h4>Width</h4>
                           <ul>
                              <li><a href="#">M</a></li>
                              <li><a href="#">W</a></li>
                           </ul>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="side border mb-1">
                            <h3>Style</h3>
                            <ul>
                                <li><a href="#">Slip Ons</a></li>
                                <li><a href="#">Boots</a></li>
                                <li><a href="#">Sandals</a></li>
                                <li><a href="#">Lace Ups</a></li>
                                <li><a href="#">Oxfords</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="side border mb-1">
                            <h3>Colors</h3>
                            <ul>
                                <li><a href="#">Black</a></li>
                                <li><a href="#">White</a></li>
                                <li><a href="#">Blue</a></li>
                                <li><a href="#">Red</a></li>
                                <li><a href="#">Green</a></li>
                                <li><a href="#">Grey</a></li>
                                <li><a href="#">Orange</a></li>
                                <li><a href="#">Cream</a></li>
                                <li><a href="#">Brown</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="side border mb-1">
                            <h3>Material</h3>
                            <ul>
                                <li><a href="#">Leather</a></li>
                                <li><a href="#">Suede</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="side border mb-1">
                            <h3>Technologies</h3>
                            <ul>
                                <li><a href="#">BioBevel</a></li>
                                <li><a href="#">Groove</a></li>
                                <li><a href="#">FlexBevel</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-xl-9">
                @if (count($products) != 0)
                    <div class="row row-pb-md">
                        @foreach ($products as $item)
                            <div class="col-lg-4 mb-4 text-center">
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
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="block-27">
                        <ul>
                            <li><a href="#"><i class="ion-ios-arrow-back"></i></a></li>
                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#"><i class="ion-ios-arrow-forward"></i></a></li>
                        </ul>
                        </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-sm-10 offset-sm-1 text-center">
                            <h2 class="mb-4">We do not find any products here!</h2>
                            <p>
                                <a href="{{url('/')}}"class="btn btn-primary btn-outline-primary">Home</a>
                                <a href="shop.html"class="btn btn-primary btn-outline-primary"><i class="icon-shopping-cart"></i> Go to cart</a>
                            </p>
                        </div>
                    </div> 
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection