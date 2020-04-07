@include('includes.manifest')
<body>
    @include('includes.header')

    @yield('content')
    
    @include('includes.footer')
    @include('includes.js')
</body>