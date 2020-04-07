<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light" style="font-family: monospace">
        <div class="container">
          <a class="navbar-brand logo_h" href="index.html" >
            <i class="fa fa-coffee" aria-hidden="true"></i> 
            Coff.ca
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <li class="nav-item active"><a class="nav-link" href="{{url('/')}}">Home</a></li>
              <li class="nav-item">
                <a href="{{url('product')}}" class="nav-link">Product</a>
							</li>
              <li class="nav-item">
                <a href="{{url('booking')}}" class="nav-link">Booking</a>
							</li>
              <li class="nav-item"><a class="nav-link" href="#">About</a></li>
            </ul>

            <ul class="nav-shop">
              <li class="nav-item"><button><i class="ti-search"></i></button></li>
              <li class="nav-item"><button><i class="ti-shopping-cart"></i><span class="nav-shop__circle">3</span></button> </li>
            <li class="nav-item"><button><a href="{{route('cus-login')}}"><i class="ti-user"></i></a></button></li>
              <li class="nav-item"></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>