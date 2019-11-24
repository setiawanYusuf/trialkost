<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Kost as KostModel;

class Kost extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke($id)
    {
        $user = Auth::user();
        $kost = KostModel::find($id);
        $kost->available_room = $kost->room - $kost->booked_room;

        return view(
            'web/detail',
            compact(
                'kost',
                'user'
            )
        );
    }
}
