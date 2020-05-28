<!DOCTYPE HTML>
<html>
    @include('includes.manifest')
    <body>
        <div>
            @include('includes.header')
            @yield('content')
            @include('includes.footer')
        </div>
        <div class="gototop js-top">
            <a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
        </div>
        @include('includes.js')
    </body>
</html>