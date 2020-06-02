@extends('layout.main')

@section('content')
<section class="login_box_area m-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="login_form_inner register_form_inner">
                    <h3>Reset Password</h3>
                    <form class="row login_form" method="POST" action="{{route('cus-handle.store')}}" id="register_form" >
                        @csrf
                        <input type="hidden" name="action" value="reset-password">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="hidden" name="mytoken" value="{{$mytoken}}">
                        <div class="col-md-12 form-group">
                            <input name="password" type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input name="confirmpassword" type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'">
                        </div>
                        <div class="text-danger mb-3 ml-3">
                            {{session('msg') ?? ""}}
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
                            <button type="submit" value="submit" class="button button-register w-100">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection