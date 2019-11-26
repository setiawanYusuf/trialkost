<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Order as OrderModel;
use App\Kost;

class Order extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {}

    public function indexByOwner($ownerId): Response
    {
        $orders = OrderModel::with('user', 'kost.user')
            ->get()
            ->map(function($val) use($ownerId) {
                if ($val->kost->user->id == $ownerId) {
                    return $val;
                }
            })->filter();

        return response(
            $orders,
            200
        );
    }

    /**
     * Update specified kost
     */
    public function store(Request $request): Response
    {
        $order = new OrderModel([
            'user_id' => $request->user_id,
            'kost_id' => $request->kost_id,
            'room_count' => $request->room_count,
            'total_price' => $request->total_price,
            'status' => OrderModel::BOOKED,
        ]);

        if ($order->save()) {
            $kost = $this->updateBookedRoomKost($request);
            if ($kost) {
                return response(
                    $kost,
                    201
                );
            }
        }
    }

    private function updateBookedRoomKost($request)
    {
        $kost = Kost::find($request->kost_id);
        $kost->booked_room = $request->booked_room;

        if ($kost->save()) {
            return $kost;
        }
    }
}
