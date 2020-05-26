<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{url('admin')}}">
            <img src="{{asset('images/icon/logo.png')}}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="has-sub" id="menu-home">
                    <a class="js-arrow" href="{{url('admin')}}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <hr>
                <li class="has-sub" id="menu-users">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-users"></i>Users</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{url('admin/user')}}"><i class="fas fa-user"></i>User</a>
                        </li>
                        <li>
                            <a href="{{url('admin/user/roles')}}"><i class="fas fa-street-view"></i>Role</a>
                        </li>
                        <li>
                            <a href="{{url('admin/user/permissions')}}"><i class="fas fa-lock "></i>Permission</a>
                        </li>
                    </ul>
                </li>
                <li id="menu-bookings">
                    <a href="{{url('admin/bookings')}}">
                        <i class="fas fa-copy"></i>Booking</a>
                </li>
                <hr>
                <li id="menu-categories">
                    <a href="{{url('admin/categories')}}">
                        <i class="fas fa-map-marker-alt"></i>Categories</a>
                </li>
                <li id="menu-products">
                    <a href="{{url('admin/products')}}">
                        <i class="fas fa-map-marker-alt"></i>Products</a>
                </li>
                <li id="menu-groups">
                    <a href="{{url('admin/groups')}}">
                        <i class="fas fa-map-marker-alt"></i>Groups</a>
                </li>
                <li id="menu-gallerys">
                    <a href="{{url('admin/gallery')}}">
                        <i class="fas fa-map-marker-alt"></i>Products Gallery</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->