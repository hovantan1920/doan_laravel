@extends('layout.main')

@section('content')
<div>

    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="{{url('/')}}">Home</a></span> / <span>Product Details</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-product">
        <div class="container">
            <div class="row row-pb-lg product-detail-wrap">
                <div class="col-sm-8">
                    <div class="owl-carousel">
                        <div class="item">
                            <div class="product-entry border">
                                <a href="#" class="prod-img">
                                    <img src="{{$product['image_source']}}" class="img-fluid" alt="{{$product['title']}}">
                                </a>
                            </div>
                        </div>
                        @if (count($gallery) != 0)
                            @foreach ($gallery as $item)
                                <div class="item">
                                    <div class="product-entry border">
                                        <a href="#" class="prod-img">
                                            <img src="{{$item['image_source']}}" class="img-fluid" alt="{{$product['title']}}">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="item">
                                <div class="product-entry border">
                                    <a href="#" class="prod-img">
                                        <img src="{{$product['image_source']}}" class="img-fluid" alt="{{$product['title']}}">
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-desc">
                        <h3>{{$product['title']}}</h3>
                        <p class="price">
                            <span>${{$product['price']}}</span> 
                            <span class="rate">
                                <i class="icon-star-full"></i>
                                <i class="icon-star-full"></i>
                                <i class="icon-star-full"></i>
                                <i class="icon-star-full"></i>
                                <i class="icon-star-half"></i>
                                (74 Rating)
                            </span>
                        </p>
                        <div class="size-wrap">
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
                        <div class="block-26 mb-4">
                                <h4>Width</h4>
                           <ul>
                              <li><a href="#">M</a></li>
                              <li><a href="#">W</a></li>
                           </ul>
                        </div>
                        </div>
                 <div class="input-group mb-4">
                     <span class="input-group-btn">
                        <button id="button-abatement" type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                       <i class="icon-minus2"></i>
                        </button>
                        </span>
                     <input type="number" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                     <span class="input-group-btn ml-1">
                        <button id="button-increment" type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                         <i class="icon-plus2"></i>
                     </button>
                     </span>
                  </div>
                  <div class="row">
                      <div class="col-sm-12 text-center">
                                <p class="addtocart" id="addtocart"><a href="#" class="btn btn-primary btn-addtocart"><i class="icon-shopping-cart"></i> Add to Cart</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-12 pills">
                            <div class="bd-example bd-example-tabs">
                              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                                <li class="nav-item">
                                  <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Description</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-expanded="true">Review</a>
                                </li>
                              </ul>

                              <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane border fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                                    {{$product['content']}}
                                </div>
                                <div class="tab-pane border fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                                  <div class="row">
                                       <div class="col-md-8">
                                           <h3 class="head">23 Reviews</h3>
                                           <div class="review">
                                               <div class="user-img" style="background-image: url(images/person1.jpg)"></div>
                                               <div class="desc">
                                                   <h4>
                                                       <span class="text-left">Jacob Webb</span>
                                                       <span class="text-right">14 March 2018</span>
                                                   </h4>
                                                   <p class="star">
                                                       <span>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-half"></i>
                                                           <i class="icon-star-empty"></i>
                                                       </span>
                                                       <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                   </p>
                                                   <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                               </div>
                                           </div>
                                           <div class="review">
                                               <div class="user-img" style="background-image: url(images/person2.jpg)"></div>
                                               <div class="desc">
                                                   <h4>
                                                       <span class="text-left">Jacob Webb</span>
                                                       <span class="text-right">14 March 2018</span>
                                                   </h4>
                                                   <p class="star">
                                                       <span>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-half"></i>
                                                           <i class="icon-star-empty"></i>
                                                       </span>
                                                       <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                   </p>
                                                   <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                               </div>
                                           </div>
                                           <div class="review">
                                               <div class="user-img" style="background-image: url(images/person3.jpg)"></div>
                                               <div class="desc">
                                                   <h4>
                                                       <span class="text-left">Jacob Webb</span>
                                                       <span class="text-right">14 March 2018</span>
                                                   </h4>
                                                   <p class="star">
                                                       <span>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-half"></i>
                                                           <i class="icon-star-empty"></i>
                                                       </span>
                                                       <span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                                                   </p>
                                                   <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-md-4">
                                           <div class="rating-wrap">
                                               <h3 class="head">Give a Review</h3>
                                               <div class="wrap">
                                                   <p class="star">
                                                       <span>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           (98%)
                                                       </span>
                                                       <span>20 Reviews</span>
                                                   </p>
                                                   <p class="star">
                                                       <span>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-empty"></i>
                                                           (85%)
                                                       </span>
                                                       <span>10 Reviews</span>
                                                   </p>
                                                   <p class="star">
                                                       <span>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-empty"></i>
                                                           <i class="icon-star-empty"></i>
                                                           (70%)
                                                       </span>
                                                       <span>5 Reviews</span>
                                                   </p>
                                                   <p class="star">
                                                       <span>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-empty"></i>
                                                           <i class="icon-star-empty"></i>
                                                           <i class="icon-star-empty"></i>
                                                           (10%)
                                                       </span>
                                                       <span>0 Reviews</span>
                                                   </p>
                                                   <p class="star">
                                                       <span>
                                                           <i class="icon-star-full"></i>
                                                           <i class="icon-star-empty"></i>
                                                           <i class="icon-star-empty"></i>
                                                           <i class="icon-star-empty"></i>
                                                           <i class="icon-star-empty"></i>
                                                           (0%)
                                                       </span>
                                                       <span>0 Reviews</span>
                                                   </p>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                </div>
                              </div>
                            </div>
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#button-increment').on('click', function () {
            var val = parseInt($('#quantity').val()) + 1;
            $('#quantity').val(val);
        });

        $('#button-abatement').on('click', function () {
            var val = parseInt($('#quantity').val()) - 1;
            if(val < 0) val = 0;
            $('#quantity').val(val);
        });

        $('#addtocart').on('click', function(){
            var current = parseInt($('#quantity').val());
            if(current <= 0) return false;
            addToCart({{$product['id']}}, current);
            return false;
        });
    });
</script>
@endsection