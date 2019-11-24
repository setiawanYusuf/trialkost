@extends('layouts.app')

@section('content')
<div class="container">
    <list-kost
        :user = "{{$user}}"
        :cities = "{{$cities}}"
    ></list-kost>
</div>
@endsection
