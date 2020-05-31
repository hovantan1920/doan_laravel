@foreach ($products as $item)
    <div class="col-md-3 col-lg-3 mb-4 text-center">
        <div class="product-entry border">
            <a href="#" class="prod-img">
                <img src="{{url("$item[image_source]")}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
            </a>
            <div class="desc">
                <h2><a href="#">{{$item['title']}}</a></h2>
                <span class="price">${{$item['price']}}</span>
            </div>
        </div>
    </div>
@endforeach