@extends('admin.layout.cool-admin')
@section('title-website')
    User - Manage
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">data table</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="property">
                        <option selected="selected">All Properties</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <div class="rs-select2--light rs-select2--sm">
                    <select class="js-select2" name="time">
                        <option selected="selected">Today</option>
                        <option value="">3 Days</option>
                        <option value="">1 Week</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <button class="au-btn-filter">
                    <i class="zmdi zmdi-filter-list"></i>filters</button>
            </div>
            <div class="table-data__tool-right">
                <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal" data-target="#modal" onclick="show_Dialog_Insert()">
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
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>serial</th>
                        <th>username</th>
                        <th>Role</th>
                        <th>email</th>
                        <th>created at</th>
                        <th>updated at</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody id="body-list">
                    @include('admin.body.users')
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE -->
    </div>
</div>     
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
            <li>The Username field is require.</li>
            <li>The Username min 6 characters.</li>
            <li>The Email field is require.</li>
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
            <label class="col-form-label">Username:</label>
            <input type="text" class="form-control" id="input-username" name="username">
          </div>
          <div class="form-group">
            <label class="col-form-label">Role:</label>
            <select name="" id="select-role" class="custom-select">
                @foreach($roles as $role)
                    @if ($role['id'] == 3)
                        @continue
                    @endif
                    <option value="{{$role['id']}}">{{$role['title']}}</option>   
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="col-form-label">Email:</label>
            <input type="email" id="input-email" name="email" class="form-control">
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

@section('script')
    <script>
        var page = 
        <?php $page = 1; if(isset($_GET['page'])) $page = $_GET['page']; echo $page; ?>; 
        var url  = "{{route('admin-users.store').'?page='}}" + page;

        //Get form
        $(document).ready(function(){

            $("#btn-send").on('click', function(){

                $id       = $("#input-id").val();
                $username = $.trim($("#input-username").val());
                $email    = $("#input-email").val();
                $role     = $("#select-role").val();
                $token    = $("input[name = '_token']").val();

                if($("#btn-send").text() == "Update"){
                    if(show_Warning()){
                        crud_Item("update", $id, $username, $email, $role, $token);
                    }
                }else {
                    if(show_Warning()){
                        crud_Item("insert", $id, $username, $email, $role, $token);
                    }
                }    
            });

            $(".btn-close-alert").on('click', function(){
                $("#alert-success").css('left', '-50%');
                $("#alert-warning").css('left', '-50%');
                $("#warning-msg").text("");
            });
        });

        //Get list for page
        function get_List(){
            $.post(
              url,
              {
                _token  : $("input[name = '_token']").val(), 
                action  : "get-list", 
                id      : 0,
                username: 0,
                email   : "_",
                role    : "_"
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
        
        //Function for crud
        function crud_Item($action, $id, $username, $email, $role, $token){
            $.post(
                url,
                {
                    _token  : $token,
                    id      : $id,
                    action  : $action,
                    username: $username,
                    email   : $email,
                    role    : $role,
                },
                function(data){
                    console.log(data);
                }
            ).done(function(){
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

        //Warning if data empty
        function show_Warning(){
            if($.trim($("#input-username").val()).length < 6){
                $("#div-warring").removeClass("d-none");
                return false;
            }
            if($.trim($("#input-email").val()).length < 1){
                $("#div-warring").removeClass("d-none");
                return false;
            }

            return true;
        }
        
        //Get a item
        function get_Item($id){
            
            $.post(
            url,
            {
              _token  : $("input[name = '_token']").val(), 
              action  : "find-one", 
              id      : $id,
              email   : "_",
              username: "_",
              password: "_",
            },
            function(data, status){
              if (status == "success") {
                $("#div-notify").addClass("d-none");
                try{
                    var model = jQuery.parseJSON(data);
                    $("#input-id").val(model.id);
                    $("#input-username").val(model.name);
                    $("#input-email").val(model.email); 
                    $("#select-role").val(model.roles_id);
                }
                catch(e){
                    $("#div-notify-get").removeClass("d-none");
                }
              }
              else
                $("#div-notify-get").removeClass("d-none");
            });
        }

        //Reset form
        function show_Dialog_Insert(){
            $("#btn-send").text('Add');
            $("#input-id").val(0);
            $("#input-username").val("");
            $("#input-email").val("");
        }

        function show_Dialog_Update($id){
            $("#btn-send").text('Update');
            $("#input-id").val($id);

            get_Item($id);
        }
    </script>

    //This functions repeat!
    <script src="{{asset('js/m-script.js')}}"></script>
@endsection