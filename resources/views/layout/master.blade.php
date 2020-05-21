<!DOCTYPE html>
<html lang="en">

@include('product::admin.includes.manifest')

<body class="animsition">
    <div class="page-wrapper">

        <div class="page-container">

            <div class="main-content">

                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @yield('content')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2020 MintColor. All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        //Include modal popup edit row
        @yield('modal')
    </div>
    
    @include('product::admin.includes.includes-js')
    @yield('script')
    
</body>

</html>