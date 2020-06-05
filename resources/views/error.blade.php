@extends('layout.main')

@section('content')
<div>
    <div class="row m-5">
        <div class="col-sm-10 offset-sm-1 text-center">
            <h2 class="mb-4">We do not find any products here!</h2>
            <p>
                <a href="{{url('/')}}"class="btn btn-primary btn-outline-primary">Home</a>
            </p>
        </div>
    </div> 
</div>
@endsection