<?php declare(strict_types=1);

namespace App\Http\Controllers\Cms;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Kost as KostModel;

class Kost extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     */
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        $user = Auth::user();
        $kosts = KostModel::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();
        $cities = $this->getCities();

        return view(
            'dashboard/kost/index',
            compact(
                'kosts',
                'user',
                'cities'
            )
        );
    }

    private function getCities()
    {
        $cities = KostModel::select('city')
            ->get()
            ->toJson();
        return $cities;
    }
}
