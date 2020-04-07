
@extends('admin.layout.account-admin')
@section('content')
    <form action="{{url('admin/account/handleadmin/das/edit')}}" method="get">
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
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
    Forget - Password
@endsection    