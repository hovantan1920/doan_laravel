
@extends('admin.layout.account-admin')
@section('content')
<form action="{{route('handleadmin.store')}}" method="post">
        @csrf
        <input type="text" name="action" value="login" hidden>
        <div class="form-group">
            <label>Username</label>
            <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
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
        <div class="text-danger">{{session('msg') ?? ""}}</div>
        <div class="login-checkbox">
            <label>
                <input type="checkbox" name="remember">Remember Me
            </label>
            <label>
                <a href="{{route('admin-forget')}}">Forgotten Password?</a>
            </label>
        </div>
        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
    </form>
@endsection    
@section('title-website')
    Login - Your Account
@endsection    