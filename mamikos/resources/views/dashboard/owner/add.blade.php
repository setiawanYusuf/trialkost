@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <owner-form
                :config="{{$config}}"
                :user="{{$user}}"
            >
            </owner-form>
        </div>
    </div>
</div>
@endsection
