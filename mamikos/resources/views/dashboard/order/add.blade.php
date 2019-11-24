@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <order-form
                :kost="{{$kost}}"
                :user="{{$user}}"
                :config="{{$config}}"
            >
            </order-form>
        </div>
    </div>
</div>
@endsection
