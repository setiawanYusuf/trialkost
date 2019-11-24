@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card" style="width: 40rem;">
            <img class="card-img-top" src="{{$kost->image_url}}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{$kost->name}}</h5>
                <p class="card-text">Description: {{$kost->description}}</p>
                <p class="card-text">City: {{$kost->city}}</p>
                <p class="card-text">Price: {{$kost->price}}</p>
                <p id="available-room" class="card-text d-none"></p>
                @if ($user)
                    @if ($user->role_id == 3 || $user->role_id == 4)
                        <a
                            href="{{
                                route(
                                    'order.add',
                                    [
                                        'id' => $kost->id
                                    ]
                            )}}"
                            class="btn btn-primary"
                        >
                            Book
                        </a>
                        <a
                            data-idKost="{{$kost->id}}"
                            data-idUser="{{$user}}"
                            id="btn-see-availability"
                            href="#"
                            class="btn btn-warning"
                        >
                            See Availability
                        </a>
                    @endif

                    @if ($user->role_id == 2)
                        <p id="available-room-owner" class="card-text">Available room: {{($kost->room-$kost->booked_room)}}</p>

                        <a href="/owner/edit/{{$kost->id}}" class="btn btn-primary">Edit</a>
                        <delete-button
                            :kost="{{$kost}}"
                        ></delete-button>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
