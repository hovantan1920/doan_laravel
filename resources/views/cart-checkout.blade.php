@extends('layout.main')

@section('content')
<div>

    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="{{url('/')}}">Home</a></span> / <span>Shopping Cart</span></p>
                </div>
            </div>
        </div>
    </div>


    <div class="colorlib-product">
        <div class="container">
            <div class="row row-pb-lg">
                <div class="col-md-10 offset-md-1">
                    <div class="process-wrap">
                        <div class="process text-center">
                            <p><span>01</span></p>
                            <h3>Shopping Cart</h3>
                        </div>
                        <div class="process text-center active">
                            <p><span>02</span></p>
                            <h3>Checkout</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>03</span></p>
                            <h3>Order Complete</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-pb-lg">
                <div class="col-md-8" id="cart-body">
                    <form action="{{url("cart-complete.html")}}"> 
                        @csrf
                        <div class="form-group">
                          <label class="col-form-label">Your name:</label>
                          <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Your numberphone:</label>
                            <input type="phone" class="form-control" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Your email:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Your address:</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Note something:</label>
                            <input type="text" class="form-control" name="note">
                        </div>
                        <input id="input-products" hidden type="text" class="form-control" name="products">
                        <input id="input-quantities" hidden type="text" class="form-control" name="quantities">
                        <div class="form-group">
                            <button class="form-control btn-primary btn">Complete</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        var products = JSON.parse(Cookies.get('cart-products') ?? "[]");
        var quantities = JSON.parse(Cookies.get('cart-quantities') ?? "[]");
        $("#input-products").val(products);
        $("#input-quantities").val(quantities);
    });
</script>
@endsection