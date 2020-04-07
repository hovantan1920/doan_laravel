@extends('product::admin.layout.cool-admin')

@section('title-website')
    Categaries - Manage
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
            <label for="recipient-name" class="col-form-label">Title item:</label>
            <input type="text" class="form-control" id="input-title" name="title-categorie">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Descride:</label>
            <textarea class="form-control" id="area-descride"></textarea>
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
                <button id="btn-add" class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#modal" onclick="show_Dialog_Insert()">
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
                        <th>created</th>
                        <th>updated</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody id="body-list">
                    @include('product::admin.ajax.categories-bodylist')
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
        var url  = "{{route('admin-categories.store').'?page='}}" + page;
        
        $(document).ready(function(){

            $("#btn-send").on('click', function(){

                $id       = $("#input-id").val();
                $title    = $.trim($("#input-title").val());
                $descride = $("#area-descride").val();
                $token    = $("input[name = '_token']").val();

                if($("#btn-send").text() == "Update"){
                    if(show_Warring()){
                        crud_Item("update", $id, $title, $descride, $token);
                    }
                }else {
                    if(show_Warring()){
                        crud_Item("insert", $id, $title, $descride, $token);
                    }
                }    
            });

            $(".btn-close-alert").on('click', function(){
                $("#alert-success").css('left', '-50%');
                $("#alert-warning").css('left', '-50%');
                $("#warning-msg").text("");
            });
        });

        function del_Item($id){
            if(confirm("You waint delete it?")){
                var token = $("input[name = '_token']").val();
                crud_Item("delete", $id, "_", "_", token);
            }
        }

        function get_List(){
            $.post(
              url,
              {
                _token  : $("input[name = '_token']").val(), 
                action  : "get-list", 
                id      : 0,
                title   : "_",
                descride: "_"
              },
              function (data, status){
                  if(status == "success"){
                    $("#body-list").html(data);
                  }else{
                    msg = "Error Refresh List!";
                    show_Alert_Warning(msg);
                  }
              }  
            );
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

        function show_Dialog_Insert(){
            $("#btn-send").text('Add');
            $("#input-id").val(0);
            $("#input-title").val("");
            $("#area-descride").val("");
        }

        function show_Dialog_Update($id){
            $("#btn-send").text('Update');
            $("#input-id").val($id);

            get_Item($id);
        }

        function crud_Item($action, $id, $title, $descride, $token){
                        
            $.post(
            url,
            {
              _token  : $token, 
              action  : $action, 
              id      : $id,
              title   : $title,
              descride: $descride
            },
            function(data, status){
              
            }).done(function(){
                $("#div-notify").addClass("d-none");
                show_Alert_Success();
                $("#btn-close").click();
                set_Loop_Hidden();
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
                show_Alert_Warning(msg);
                set_Loop_Hidden();
            });
        }

        function get_Item($id){
            
            $.post(
            url,
            {
              _token  : $("input[name = '_token']").val(), 
              action  : "find-one", 
              id      : $id,
              title   : "_",
              descride: "_"
            },
            function(data, status){
              if (status == "success") {
                $("#div-notify").addClass("d-none");
                try{
                    var categorie = jQuery.parseJSON(data);
                    $("#input-id").val(categorie.id);
                    $("#input-title").val(categorie.title);
                    $("#area-descride").val(categorie.descride); 
                }
                catch(e){
                    $("#div-notify-get").removeClass("d-none");
                }
              }
              else
                $("#div-notify-get").removeClass("d-none");
            });
        }

        function show_Warring(){
            if($.trim($("#input-title").val()).length < 1){
                $("#div-warring").removeClass("d-none");
                return false;
            }
            if($.trim($("#area-descride").val()).length < 1){
                $("#div-warring").removeClass("d-none");
                return false;
            }

            return true;
        }

    </script>

    //This functions repeat!
    <script src="{{asset('js/m-script.js')}}"></script>
@endsection