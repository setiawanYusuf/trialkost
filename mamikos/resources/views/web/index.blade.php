@extends('layouts.app')

@section('content')
<div class="container">
    <list-kost
        :user = "{{$userJson}}"
        :cities = "{{$cities}}"
    ></list-kost>
</div>
@endsection
