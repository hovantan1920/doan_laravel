<!DOCTYPE html>
<html lang="en">

@include('admin.includes.manifest')

<body class="animsition">
    <div class="page-wrapper">

        @include('admin.includes.header-mobile')

        @include('admin.includes.menu-sidebar')

        <div class="page-container">
            @include('admin.includes.header-desktop')

            <div class="main-content">

                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @yield('modal')
    </div>
    
    @include('admin.includes.includes-js')
    @include('admin.includes.js-activebar')
    @yield('script')
    
</body>

</html>