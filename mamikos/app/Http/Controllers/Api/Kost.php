<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Kost as KostModel;

class Kost extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {}

    public function index(): Response
    {
        $kosts = KostModel::orderBy(
                'updated_at',
                'desc'
            )->paginate();

        return response(
            $kosts
        );
    }

    public function indexByOwner($ownerId): Response
    {
        $kosts = KostModel::owner($ownerId)
            ->orderBy(
                'updated_at',
                'desc'
            )->paginate();

        return response(
            $kosts
        );
    }

    /**
     * Store new kost
     */
    public function store(Request $request): Response
    {
        $kost = new KostModel([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'room' => $request->room,
            'city' => $request->city,
            'user_id' => $request->user_id,
        ]);
        $kost->save();

        return response(
            $kost,
            201
        );
    }

    /**
     * Update specified kost
     */
    public function update(Request $request, $id): Response
    {
        $kost = KostModel::find($id);
        $kost->name = $request->name ?? $kost->title;
        $kost->description = $request->description ?? $kost->description;
        $kost->price = $request->price ?? $kost->price;
        $kost->room = $request->room ?? $kost->room;
        $kost->city = $request->city ?? $kost->city;
        $kost->save();

        return response(
            $kost,
            200
        );
    }

    /**
     * Delete specified kost
     */
    public function delete($id): Response
    {
        $kost = KostModel::find($id);
        $name = $kost->name;
        $kost->delete();

        return response(
            [
                'id' => $id,
                'name' => $name,
            ],
            204
        );
    }

    /**
     * Filter showed data
     */
    public function filter(Request $request): Response
    {
        $city = 'all';
        if (isset($request->city)) {
            $city = strtolower($request->city) === 'all' ? '' : strtolower($request->city);
        }

        $name = '';
        if (isset($request->name)) {
            $name = strtolower($request->name) === '' ? '' : strtolower($request->name);
        }

        $kost = KostModel::name($name)
            ->city($city)
            ->price($request->priceFrom, $request->priceTo, $request->sortPrice)
            ->orderBy('updated_at', 'desc')
            ->get();

        return response(
            $kost,
            200
        );
    }

    /**
     * Check available room for specific cost
     */
    public function availableRoom(Request $request): Response
    {
        $kost = KostModel::select('room', 'booked_room')
            ->where(
                'id',
                $request->id
            )->first();

        return response(
            $kost,
            200
        );
    }
}
