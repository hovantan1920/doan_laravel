@extends('layout.main')
@section('content')

<div class="modal fade mt-5 pt-5" id="modalForgetPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Forget Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('cus/sendMail')}}" method="GET">
            <div class="modal-body form-group">
                <input class="form-control" type="text" placeholder="Enter your email!" name="email">
            </div>
            <div class="modal-footer">
              <button type="button" required class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Resert Password</button>
            </div>
        </form>
      </div>
    </div>
  </div>
<!--================Login Box Area =================-->
<section class="login_box_area m-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <div class="hover">
                        <h4>New to our website?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                    <a class="button button-account" href="{{route('cus-register')}}">Create an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Log in to enter</h3>
                    <form class="row login_form" method="POST" action="{{route('cus-handle.store')}}" id="contactForm" >
                        @csrf
                        <input type="hidden" name="action" value="login">
                        <div class="col-md-12 form-group">
                            <input value="{{$username ?? ""}}" required type="text" class="form-control" id="input-username" name="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input value="{{$password ?? ""}}" required type="password" class="form-control" id="input-password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="selector-remember" 
                                @if ($remember ?? false)
                                    {{ 'checked' }}
                                @endif>
                                <label for="f-option2">Keep me logged in</label>
                            </div>
                        </div>
                        <div class="text-danger mb-3 ml-3">
                            {!!session('msg') ?? ""!!}
                        </div>
                        <div class="pl-3">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="button button-login w-100">Log In</button>
                            <button type="button" class="mt-2 btn btn-link" data-toggle="modal" data-target="#modalForgetPassword">
                                Forgot Password?
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection