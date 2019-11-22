@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($kosts as $val)
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{$val->image_url}}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{$val->name}}</h5>
                <p class="card-text">{{$val->description}}</p>
                <a href="#" class="btn btn-primary">Book</a>
                <a href="#" class="btn btn-warning">Information</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
