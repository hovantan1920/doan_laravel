<nav class="colorlib-nav" role="navigation">
  <div class="top-menu">
    <div class="container">
      <div class="row">
        <div class="col-sm-7 col-md-9">
          <div id="colorlib-logo"><a href="index.html">Footwear</a></div>
        </div>
        <div class="col-sm-5 col-md-3">
              <form action="#" class="search-wrap">
                 <div class="form-group">
                    <input type="search" class="form-control search" placeholder="Search">
                    <button class="btn btn-primary submit-search text-center" type="submit"><i class="icon-search"></i></button>
                 </div>
              </form>
           </div>
         </div>
      <div class="row">
        <div class="col-sm-12 text-left menu-1">
          <ul>
          <li class="active"><a href="{{url('/')}}">Home</a></li>
          @foreach ($categories as $item)
            <li class="has-dropdown">
              <a href="{{url('/')}}">{{$item['title']}}</a>
              @if (count($item['children']) != 0)
                <ul class="dropdown">
                  @foreach ($item['children'] as $sub)
                    <li><a href="product-detail.html">{{$sub['title']}}</a></li>
                  @endforeach
                </ul>
              @endif
            </li>
          @endforeach
            <li class="cart"><a href="cart.html"><i class="icon-shopping-cart"></i> Cart [0]</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="sale">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 offset-sm-2 text-center">
          <div class="row">
            <div class="owl-carousel2">
              <div class="item">
                <div class="col">
                  <h3><a href="#">25% off (Almost) Everything! Use Code: Summer Sale</a></h3>
                </div>
              </div>
              <div class="item">
                <div class="col">
                  <h3><a href="#">Our biggest sale yet 50% off all summer shoes</a></h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>