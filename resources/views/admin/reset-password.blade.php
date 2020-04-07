
@extends('admin.layout.account-admin')
@section('content')
    <form action="{{url('admin/account/handleadmin/resetpassword')}}" method="post">
        @method('PUT')
        @csrf
        <input type="hidden" name="mytoken" value="{{$mytoken}}">
        <input type="hidden" name="email" value="{{$email}}">
        <div class="form-group">
            <label>Your password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label>Confirm password</label>
            <input class="au-input au-input--full" type="password" name="confirmpassword" placeholder="Repeat Password">
        </div>
        <div class="text-danger">{{session('msg') ?? ""}}</div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">submit</button>
    </form>
@endsection    
@section('title-website')
    Reset - Password
@endsection    