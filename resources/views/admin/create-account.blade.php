
@extends('admin.layout.account-admin')
@section('content')
<form action="{{route('handle.store')}}" method="post" class="mb-5">
        @csrf
        <input type="hidden" value="register" name="action">
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group col-sm-6">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group col-sm-6">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group col-sm-6">
                <label>Confirm Password</label>
                <input class="au-input au-input--full" type="password" name="confirm-password" placeholder="Confirm Password" required>
            </div>
        </div>
        
        <div class="login-checkbox">
            <label>
                <input type="checkbox" name="aggree" required>Agree the terms and policy
            </label>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="text-danger">{{session('status') ?? ""}}</div>
        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{route('login')}}">Sign In</a>
        </p>
    </div>
@endsection    
@section('title-website')
    Login - Your Account
@endsection    