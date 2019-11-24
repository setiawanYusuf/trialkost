@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <list-order
                :user="{{$userJson}}"
            ></list-order>
        </div>
    </div>
</div>
@endsection
