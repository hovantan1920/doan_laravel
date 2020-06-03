@extends('admin.layout.cool-admin')

@section('title-website')
    Products
@endsection

@section('modal')
<style>
    .alert{
        position: fixed;
        left: -50%;
        bottom: 5px;
        width: auto;
        overflow: hidden;
        transition: 2s;
        z-index: 999;
    }
</style>
<div id="alert-success" class="alert alert-success" >
    <strong class="ml-3">Success!</strong><i class="fa fa-times ml-3 btn-close-alert " aria-hidden="true" id=""></i>
</div>
<div id="alert-warning" class="alert alert-warning">
    <strong>Warning!</strong> <span id="warning-msg"></span><i class="fa fa-times ml-3 btn-close-alert" aria-hidden="true" id=""></i>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Item Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body m-2 p-4">
        <div id="div-warring" class="bg-danger pl-5 py-2 text-white d-none">
            <ul>
            <li>The title field is require.</li>
            <li>The descride field is require.</li>
            </ul>
        </div>
        <div id="div-notify" class="bg-danger pl-5 py-2 text-white d-none">
            Has error when insert data.
        </div>
        <div id="div-notify-get" class="bg-danger pl-5 py-2 text-white d-none">
            Has error when get data.
        </div>
        <form>
          @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Title</label>
            <input type="text" class="form-control" id="input-title" name="title-categorie">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Image</label>
            <div class="form-row">
                <div class="col-md-10">
                <input type="text" class="form-control" id="input-image" placeholder="Name image..." disabled>
                </div>
                <div class="col-md-2 text-center">
                    <button id="choose-image" class="btn btn-primary">Choose</button>
                </div>
            </div>  
            <div>
                <div id="preview">
                </div>
                <div class="clearfix"></div>
            </div>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Gallery</label>
            <div class="form-row">
                <div class="col-md-10">
                <input type="text" class="form-control" id="input-gallery" placeholder="Images..." disabled>
                </div>
                <div class="col-md-2 text-center">
                    <button id="choose-gallery" class="btn btn-primary">Choose</button>
                </div>
            </div>  
            <div>
                <div id="previews">
                    {{-- @isset($product->gallery)
                        @if(!empty($product->gallery))
                            @foreach(\Modules\Product\Entities\GalleryProduct::where('product_id', $product->id)->get() as $file)
                                <div class="gallery imgprev-wrap imgprev-wrap-gallery" style="display:block">
                                    <input type="hidden" name="images[]" value="{{ $file->image }}">
                                    <img class="img-preview" src="{{ asset($file->image) }}" alt="">
                                    <i class="fa fa-trash text-danger" onclick="return deleteFile(this)"></i>
                                </div>
                            @endforeach
                        @endif
                    @endisset --}}
                </div>
                <div class="clearfix"></div>
            </div>
          </div> 
          <div class="form-group">
            <div class="form-group">
              <label for="message-text" class="col-form-label">Content</label>
              <textarea class="form-control" id="area-content"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Price</label>
            <input type="number" class="form-control" id="input-price">
          </div>
          <label for="recipient-name" class="col-form-label">Price Compare</label>
          <input type="number" class="form-control" id="input-price_compare">
          <div class="form-group">
            <label for="sel1">From category:</label>
            <select class="form-control" id="select-category_id">
              @foreach ($categories as $item)
                <option value="{{$item['id']}}">{{$item['title']}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="sel1">From group:</label>
            <select class="form-control" id="select-group_id">
              <option selected>---------</option>
              @foreach ($groups as $item)
                <option value="{{$item['id']}}">{{$item['title']}}</option>
              @endforeach
            </select>
          </div>
          <input type="submit" id="input-id" name="input-id" value="0" hidden>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close">Close</button>
        <button type="button" class="btn btn-primary" id="btn-send">Add</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">data table</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="property" id="property">
                        <option selected="selected" value="none">All Properties</option>
                        <option value="title">Title Properties</option>
                        <option value="created_at">Created Properties</option>
                        <option value="updated_at">Updated Properties</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <div class="rs-select2--light rs-select2--sm">
                    <select class="js-select2" name="value-property" id="value-property">
                        <option selected="selected" value="normal">Normal</option>
                        <option value="asc">Filter UP</option>
                        <option value="desc">Filter Down</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <button class="au-btn-filter">
                    <i class="zmdi zmdi-filter-list"></i>filters</button>
            </div>
            <div class="table-data__tool-right">
                <button id="btn-add" class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#modal" onclick="formInsert()">
                    <i class="zmdi zmdi-plus"></i>add item</button>
                <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                    <select class="js-select2" name="type">
                        <option selected="selected">Export</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
            </div>
        </div>
        {{$list->links()}}
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>serial</th>
                        <th>title</th>
                        <th>price</th>
                        <th>price compare</th>
                        <th>category</th>
                        <th>group</th>
                        <th>update</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody id="body-list">
                    @include('product::body.products')
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE -->
        <div class="float-right">
            {{$list->links()}}
        </div>
    </div>
</div>
       
@endsection    

@section('script')
    <script>
        var page = 
        <?php $page = 1; if(isset($_GET['page'])) $page = $_GET['page']; echo $page; ?>; 
        var gallery = [];
        
        $(document).ready(function(){

            $("#choose-image").on('click', function(){
                CKFinder.popup( {
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function( finder ) {
                        finder.on( 'files:choose', function( evt ) {
                            var file = evt.data.files.first();
                            $("#input-image").val(file.getUrl());
                            var html = '<div class="m-2 float-left" style="display:block">'
                                        + '<img class="rounded m-1" style="height: 150px; width: 150px" src="'+file.getUrl()+'"/>'
                                    + '</div>';
                            $("#preview").html(html);
                        } );

                        finder.on( 'file:choose:resizedImage', function( evt ) {
                            $("#input-image").val(evt.data.file.getUrl());
                            var html = '<div class="m-2 float-left" style="display:block">'
                                        + '<img class="rounded m-1" style="height: 150px; width: 150px" src="'+evt.data.file.getUrl()+'"/>'
                                    + '</div>';
                            $("#preview").html(html);
                        } );
                    }
                } );
                return false;
            });
            $("#choose-gallery").on('click', function(){
                CKFinder.modal( {
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function( finder ) {
                        finder.on( 'files:choose', function( evt ) {
                            console.log(evt.data.files);
                            var files = evt.data.files;
                            var html = '';
                            $("#input-gallery").val("Choosed: " + files.length + " file");
                            $("#previews").addClass("bg-light");
                            files.forEach( function( file, i ) {
                                gallery.push(file.getUrl());
                                html += '<div class="m-1 float-left" style="display:block">'
                                        + '<img class="rounded m-1" style="height: 150px; width: 150px" src="'+file.getUrl()+'"/>'
                                    + '</div>';
                            } );
                            $("#previews").html(html);
                        } );
                    }
                } );
                return false;
            });

            $("#btn-send").on('click', function(){

                $id       = $("#input-id").val();
                $title    = $.trim($("#input-title").val());
                $image_souce = $("#input-image").val();
                $price    = $.trim($("#input-price").val());
                $price_compare    = $.trim($("#input-price_compare").val());
                $category_id    = $.trim($("#select-category_id").val());
                $group_id    = $.trim($("#select-group_id").val());
                $content = $("#area-content").val();
                $token    = $("input[name = '_token']").val();

                if(validate()){
                    if($("#btn-send").text() == "UPDATE"){
                        update($id, $title, $image_souce, $price, $price_compare, $category_id, $group_id, $content, $token);
                    }else {
                        create($title, $image_souce, $price, $price_compare, $category_id, $group_id, $content, $token);
                    }    
                }
            });

            $(".btn-close-alert").on('click', function(){
                $("#alert-success").css('left', '-50%');
                $("#alert-warning").css('left', '-50%');
                $("#warning-msg").text("");
            });
        });

        function deleteFile(object){
            console.log(object);
        }

        function create($title, $image_souce, $price, $price_compare, $category_id, $group_id, $content, $token){
            $.post(
            "{{route('products.store').'?page='}}" + page,
            {
              _token  : $token, 
              title   : $title,
              price   : $price,
              image_source : $image_souce,
              gallery : gallery,
              price_compare  : $price_compare,
              category_id: $category_id,
              content: $content,
              group_id: $group_id
            },
            function(data, status){
                if(data['success']){
                    gallery = [];
                    $("#div-notify").addClass("d-none");
                    messageSuccess();
                    $("#btn-close").click();
                }
                else{
                    console.log(data['msg']);
                    msg = "Error insert!";
                    $("#div-notify").removeClass("d-none");
                    messageWarning(msg);
                }
            }).done(function(){
                
            }).fail(function(xhr, status, error){
                switch(xhr.status){
                    case 500:
                        msg = "Error server!";
                        break;
                    default:
                        msg = "Error server!";
                        break;   
                }
                if($action == "insert" || $action == "update")
                    $("#div-notify").removeClass("d-none");
                messageWarning(msg);
            });
        }
        function showDialogUpdate($id){
            $("#btn-send").text('UPDATE');
            $("#input-id").val($id);

            getItem($id);
        }
        function getItem($id){
            var url = "{{route('products.show', 0)}}" + $id; 
            $.ajax({
                url : url,
                type: 'GET',
                success: function ($data){
                    if ($data['success']) {
                        $("#div-notify").addClass("d-none");
                        try{    
                            $("#input-id").val($data['result']['id']);
                            $("#input-title").val($data['result']['title']);
                            $("#input-image").val($data['result']['image_source']);
                            $("#input-price").val($data['result']['price']);
                            $("#input-price_compare").val($data['result']['price_compare']);
                            $("#select-category_id").val($data['result']['category_id']);
                            $("#select-group_id").val($data['result']['group_id']);
                            $("#area-content").val($data['result']['content']); 
                            if($data['result']['image_source'] != null){
                                var html = '<div class="m-2 float-left" style="display:block">'
                                        + '<img class="rounded m-1" style="height: 150px; width: 150px" src="'+$data['result']['image_source']+'"/>'
                                        + '</div>';
                                $("#preview").html(html);
                            }
                            $("#input-gallery").val("Choosed: " + $data['gallery'].length);
                        }
                        catch(e){
                            console.log(e);
                            $("#div-notify-get").removeClass("d-none");
                        }
                    }
                    else
                        $("#div-notify-get").removeClass("d-none");
                },
                error: function ($error) {

                }
            });
        }

        function update($id, $title, $image_souce, $price, $price_compare, $category_id, $group_id, $content, $token){
            var url = "{{route('products.update', 0)}}" + $id; 
            $.ajax({
                url: url,
                type: 'PUT',
                data: gallery.length != 0 ? {
                    _token  : $token, 
                    title   : $title,
                    price   : $price,
                    image_source : $image_souce,
                    gallery : gallery,
                    price_compare  : $price_compare,
                    category_id: $category_id,
                    content: $content,
                    group_id: $group_id
                } : {
                    _token  : $token, 
                    title   : $title,
                    price   : $price,
                    image_source : $image_souce,
                    price_compare  : $price_compare,
                    category_id: $category_id,
                    content: $content,
                    group_id: $group_id
                },
                error: function(error){
                    messageWarning('Error...');
                },
                success: function(data) {
                    if(data['success']){
                        gallery = [];
                        $("#div-notify").addClass("d-none");
                        messageSuccess();
                        $("#btn-close").click();
                    }
                    else{
                        console.log(data['msg']);
                        $("#div-notify").removeClass("d-none");
                        messageWarning('Error...');
                    }
                }
            });
        }

        function remove($id){
            if(confirm("You waint delete it?")){
                var token = $("input[name = '_token']").val();
                var url = "{{route('products.destroy', 0)}}" + $id; 
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token  : token, 
                    },
                    error: function(error){
                        messageWarning('Error...');
                    },
                    success: function(data) {
                        if(data['success']){
                            messageSuccess();
                        }
                        else{
                            console.log(data['msg']);
                            messageWarning('Error...');
                        }
                    }
                });
            }
        }

        function refresh(){
            $.ajax({
                url: "{{route('products.create')}}",
                type: 'GET',
                error: function (error) {
                    msg = "Error refresh data!";
                    messageWarning(msg);
                },
                success: function (data){
                    $("#body-list").html(data);
                }
            });
        }

        function formInsert(){
            $("#btn-send").text('Add');
            $("#input-id").val(0);
            $("#input-title").val("");
            $("#input-image").val("");
            $("#select_active").val(1);
            $("#select_parent").val(0);
            $("#preview").html('');
            $("#area-descride").val("");
        }

        function validate(){
            if($.trim($("#input-title").val()).length < 1){
                $("#div-warring").removeClass("d-none");
                return false;
            }
            if($.trim($("#area-content").val()).length < 1){
                $("#div-warring").removeClass("d-none");
                return false;
            }

            return true;
        }

    </script>

    @include('ckfinder::setup')
    <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
    <script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
    //This functions repeat!
    <script src="{{asset('js/m-script.js')}}"></script>
@endsection