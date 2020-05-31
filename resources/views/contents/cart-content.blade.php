    <div class="product-name d-flex">
        <div class="one-forth text-left px-4">
            <span>Product Details</span>
        </div>
        <div class="one-eight text-center">
            <span>Price</span>
        </div>
        <div class="one-eight text-center">
            <span>Quantity</span>
        </div>
        <div class="one-eight text-center">
            <span>Total</span>
        </div>
        <div class="one-eight text-center px-4">
            <span>Remove</span>
        </div>
    </div>
@for ($i = 0; $i < count($products); $i++)
    <div class="product-cart d-flex">
        <div class="one-forth">
            <div class="product-img" style="background-image: url(images/item-6.jpg);">
            </div>
            <div class="display-tc">
                <h3>{{$products[$i]['title']}}</h3>
            </div>
        </div>
        <div class="one-eight text-center">
            <div class="display-tc">
                <span class="price">${{$products[$i]['price']}}</span>
            </div>
        </div>
        <div class="one-eight text-center">
            <div class="display-tc">
                <input type="text" name="quantity" class="form-control input-number text-center" value="{{$quantities[$i]}}" min="1" max="100">
            </div>
        </div>
        <div class="one-eight text-center">
            <div class="display-tc">
                <span class="price">${{$products[$i]['price'] * $quantities[$i]}}</span>
            </div>
        </div>
        <div class="one-eight text-center">
            <div class="display-tc">
                <a href="#" class="closed"></a>
            </div>
        </div>
    </div>
@endfor