<nav class="colorlib-nav" role="navigation">
  <div class="top-menu">
    <div class="container">
      <div class="row">
        <div class="col-sm-7 col-md-9">
          <div id="colorlib-logo"><a href="{{url('/')}}">F-Interesting</a></div>
        </div>
        <div class="col-sm-5 col-md-3">
              <form action="{{url('search.html')}}" class="search-wrap" method="GET">
                 <div class="form-group">
                    <input name="keyword" type="search" class="form-control search" placeholder="Search">
                    <button class="btn btn-primary submit-search text-center" type="submit"><i class="icon-search"></i></button>
                 </div>
              </form>
           </div>
         </div>
      <div class="row">
        <div class="col-sm-12 text-left menu-1">
          <ul>
          <li id="nav-home"><a href="{{url('/')}}">Home</a></li>
          @foreach ($categories as $item)
            <li id="nav-{{$item['slug']}}" class="has-dropdown">
              <a href="{{url("$item[slug]")}}.html">{{$item['title']}}</a>
              @if (count($item['children']) != 0)
                <ul class="dropdown">
                  @foreach ($item['children'] as $sub)
                    <li><a href="{{url("$sub[slug]")}}.html">{{$sub['title']}}</a></li>
                  @endforeach
                </ul>
              @endif
            </li>
          @endforeach
            <li id="nav-cart" class="cart"><a href="{{url('cart.html')}}"><i class="icon-shopping-cart"></i> Cart [<span id="span-cart">0</span>]</a></li>
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