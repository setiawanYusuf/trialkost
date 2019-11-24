<?php declare(strict_types=1);

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Kost;
use App\Order as OrderModel;

class Order extends Controller
{
   /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function add($id): \Illuminate\Contracts\Support\Renderable
    {
        $kost = Kost::find($id)->toJson();
        $user = Auth::user()->toJson();
        $config = json_encode([
            'label' => 'Add Order',
        ]);

        return view(
            'dashboard/order/add',
            compact(
                'kost',
                'user',
                'config'
            )
        );
    }

    public function edit($id): \Illuminate\Contracts\Support\Renderable
    {
        $kost = Kost::find($id)->toJson();
        $user = Auth::user()->toJson();
        $config = json_encode([
            'label' => 'Edit Order',
        ]);

        return view(
            'dashboard/owner/add',
            compact(
                'kost',
                'user',
                'config'
            )
        );
    }
}
