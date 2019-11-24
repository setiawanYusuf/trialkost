<?php declare(strict_types=1);

namespace App\Http\Controllers\Cms;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Order as OrderModel;
use App\Kost;

class Order extends Controller
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
        $userJson = json_encode($user);

        return view(
            'dashboard/order/index',
            compact(
                'userJson'
            )
        );
    }
}
