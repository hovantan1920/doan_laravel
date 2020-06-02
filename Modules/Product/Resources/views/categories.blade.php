@extends('admin.layout.cool-admin')
@section('title-website')
    Categories
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Item Categorie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
                <div class="col-md-9">
                <input type="text" class="form-control" id="input-image" placeholder="Name image..." disabled>
                </div>
                <div class="col-md-3">
                    <button id="choose-image" class="btn btn-primary">Choose</button>
                </div>
            </div>  
          </div> 
          <div class="form-group">
            <div class="form-group">
              <label for="message-text" class="col-form-label">Description</label>
              <textarea class="form-control" id="area-description"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Active</label>
            <input type="number" class="form-control" id="select-active">
          </div>
          <div class="form-group">
            <label>Parent</label>
            <select class="form-control" id="select-parent">
                @foreach ($parents as $item)
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
                        <th>serial</th>
                        <th>title</th>
                        <th>descride</th>
                        <th>active</th>
                        <th>parent</th>
                        <th>updated</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody id="body-list">
                    @include('product::body.categories')
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
        var url  = "";
        
        $(document).ready(function(){
            $("#choose-image").on('click', function(){
                CKFinder.popup( {
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function( finder ) {
                        finder.on( 'files:choose', function( evt ) {
                            var file = evt.data.files.first();
                            $("#input-image").val(file.get('name'));
                        } );

                        finder.on( 'file:choose:resizedImage', function( evt ) {
                            $("#input-image").val(evt.data.file.get( 'name' ));
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
                $parent_id    = $.trim($("#select-parent").val());
                $active    = $.trim($("#select-active").val());
                $description = $("#area-description").val();
                $token    = $("input[name = '_token']").val();

                if(validate()){
                    if($("#btn-send").text() == "UPDATE"){
                        update($id, $title, $image_source, $active, $parent_id, $description, $token);
                    }else {
                        create($title, $image_source, $active, $parent_id, $description, $token);
                    }    
                }
            });

            $(".btn-close-alert").on('click', function(){
                $("#alert-success").css('left', '-50%');
                $("#alert-warning").css('left', '-50%');
                $("#warning-msg").text("");
            });
        });

        function create($title, $image_source, $active, $parent_id, $description, $token){
            $.post(
            "{{route('categories.store').'?page='}}" + page,
            {
              _token  : $token, 
              title   : $title,
              image_source   : $image_source,
              active  : $active,
              parent_id: $parent_id,
              description: $description
            },
            function(data, status){
                if(data['success']){
                    $("#div-notify").addClass("d-none");
                    messageSuccess();
                    $("#btn-close").click();
                }
                else{
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
            var url = "{{route('categories.show', 0)}}" + $id + "?page=" + page; 
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
                            $("#select-active").val($data['result']['active']);
                            $("#select-parent").val($data['result']['parent_id']);
                            $("#area-description").val($data['result']['description']); 
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

        function update($id, $title, $image_source, $active, $parent_id, $description, $token){
            var url = "{{route('categories.update', 0)}}" + $id; 
            $.ajax({
                url: url,
                type: 'PUT',
                data: {
                    _token  : $token, 
                    title   : $title,
                    image_source   : $image_source,
                    active  : $active,
                    parent_id: $parent_id,
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
                var url = "{{route('categories.destroy', 0)}}" + $id; 
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
                url: "{{route('categories.create')}}",
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
            $("#select_active").val(1);
            $("#select_parent").val(0);
            $("#area-descride").val("");
        }

        function validate(){
            if($.trim($("#input-title").val()).length < 1){
                $("#div-warring").removeClass("d-none");
                return false;
            }
            if($.trim($("#area-description").val()).length < 1){
                $("#div-warring").removeClass("d-none");
                return false;
            }

            return true;
        }

    </script>

    @include('ckfinder::setup')
    //This functions repeat!
    <script src="{{asset('js/m-script.js')}}"></script>
    // <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
    // <script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
@endsection