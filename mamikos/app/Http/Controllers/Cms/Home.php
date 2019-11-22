<?php declare(strict_types=1);

namespace App\Http\Controllers\Cms;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Kost;

class Home extends Controller
{
    //protected $guards = 'web';

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
    public function __invoke(): \Illuminate\Contracts\Support\Renderable
    {
        $user = Auth::user();
        $kosts = Kost::where('user_id', $user->id)->get();

        return view(
            'dashboard/index',
            compact(
                'kosts',
                'user'
            )
        );
    }
}
