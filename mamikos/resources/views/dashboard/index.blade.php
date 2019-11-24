@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- @foreach($kosts as $val)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{$val->image_url}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$val->name}}</h5>
                    <p class="card-text">{{$val->description}}</p>
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-warning">Delete</a>
                </div>
            </div>
        @endforeach
        <br/>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                @if ($user->role_id == 1 || $user->role_id == 2)
                    <div class="card-body">
                        <a href="{{route('owner.add')}}">
                            <button
                                type="button"
                                class="btn btn-success"
                            >
                                Add
                            </button>
                        </a>
                    </div>
                @endif

                @if ($user->role_id == 1 || $user->role_id == 3 || $user->role_id == 4)
                    <div class="card-body">
                        <button
                            type="button"
                            class="btn btn-success"
                        >
                            Book
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                        >
                            Cancel Book
                        </button>
                    </div>
                @endif


            </div>
        </div> -->
    </div>
</div>
@endsection
