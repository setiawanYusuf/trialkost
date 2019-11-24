<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Kost;

class Home extends Controller
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
    public function index()
    {
        $user = Auth::user();
        $userJson = json_encode($user);

        $kosts = $this->getKosts($user);
        $cities = $this->getCities();

        return view(
            'web/index',
            compact(
                'kosts',
                'userJson',
                'cities'
            )
        );
    }

    private function getKosts($user)
    {
        if ($user) {
            if ($user->role_id == 2) {
                return Kost::where('user_id', $user->id)
                    ->orderBy('updated_at', 'desc')
                    ->get();
            }

            if ($user->role_id == 3 || $user->role_id == 4) {
                return Kost::orderBy('updated_at', 'desc')->get();
            }
        }

        return Kost::orderBy('updated_at', 'desc')->get();
    }

    private function getCities()
    {
        $cities = Kost::select('city')->get()->toJson();
        return $cities;
    }
}
