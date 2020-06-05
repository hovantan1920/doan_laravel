@extends('admin.layout.cool-admin')
@section('title-website')
    Brands
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
        <h5 class="modal-title" id="exampleModalLabel">CREATE NEW BRAND</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  p-4 m-2">
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
            <input type="text" class="form-control" id="input-title">
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
            <div class="form-group">
              <label for="message-text" class="col-form-label">Description</label>
              <textarea class="form-control" id="area-description"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Country</label>
            <input type="text" class="form-control" id="input-country">
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
                <button class="au-btn-filter" onclick="filter_List()">
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
                        <th>logo</th>
                        <th>title</th>
                        <th>description</th>
                        <th>country</th>
                        <th>updated</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody id="body-list">
                    @include('product::body.brands')
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
                                        + '<img class="rounded m-1" style="height: 150px; width: 250px" src="'+file.getUrl()+'"/>'
                                    + '</div>';
                            $("#preview").html(html);
                        } );

                        finder.on( 'file:choose:resizedImage', function( evt ) {
                            $("#input-image").val(evt.data.file.getUrl());
                        } );
                    }
                } );
                return false;
            });

            $("#btn-send").on('click', function(){
                $('.btn').prop('disabled', false);
                $id       = $("#input-id").val();
                $title    = $.trim($("#input-title").val());
                $image_source    = $.trim($("#input-image").val());
                $country    = $.trim($("#input-country").val());
                $description = $("#area-description").val();
                $token    = $("input[name = '_token']").val();

                if(validate()){
                    if($("#btn-send").text() == "UPDATE"){
                        update($id, $title, $image_source, $country, $description, $token);
                    }else {
                        create($title, $image_source, $country, $description, $token);
                    }    
                }
            });

            $(".btn-close-alert").on('click', function(){
                $("#alert-success").css('left', '-50%');
                $("#alert-warning").css('left', '-50%');
                $("#warning-msg").text("");
            });
        });

        function create($title, $image_source, $country, $description, $token){
            $.post(
            "{{route('brands.store')}}",
            {
              _token  : $token, 
              title   : $title,
              image_source   : $image_source,
              country  : $country,
              description: $description
            },
            function(data, status){
                if(data['success']){
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
            var url = "{{route('brands.show', 0)}}" + $id; 
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
                            $("#input-country").val($data['result']['country']);
                            $("#area-description").val($data['result']['description']); 
                            if($data['result']['image_source'] != null){
                                var html = '<div class="m-2 float-left" style="display:block">'
                                        + '<img class="rounded m-1" style="height: 150px; width: 250px" src="'+$data['result']['image_source']+'"/>'
                                    + '</div>';
                                $("#preview").html(html);
                            }
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

        function update($id, $title, $image_source, $country, $description, $token){
            var url = "{{route('brands.update', 0)}}" + $id; 
            $.ajax({
                url: url,
                type: 'PUT',
                data: {
                    _token  : $token, 
                    title   : $title,
                    image_source   : $image_source,
                    country  : $country,
                    description: $description
                },
                error: function(error){
                    messageWarning('Error...');
                },
                success: function(data) {
                    if(data['success']){
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
                var url = "{{route('brands.destroy', 0)}}" + $id; 
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
                url: "{{route('brands.create')}}",
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

        function filter_List(){

            $property  = $("#property").val();
            $value     = $("#value-property").val();

            $.post(
              url,
              {
                _token  : $("input[name = '_token']").val(), 
                action  : "filter-list", 
                id      : 0,
                title   : "_",
                descride: "_",
                property: $property,
                value   : $value
              },
              function (data, status){
                  if(status == "success"){
                    $("#body-list").html(data);
                  }else{
                    msg = "Error Filter List!";
                    show_Alert_Warning(msg);
                  }
              }  
            );
        }

        function formInsert(){
            $("#btn-send").text('Add');
            $("#input-id").val(0);
            $("#input-title").val("");
            $("#input-image").val("");
            $("#input-country").val("");
            $("#area-description").val("");
            $("#preview").html('');
        }

        function validate(){
            if($.trim($("#input-title").val()).length < 1){
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