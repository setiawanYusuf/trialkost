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

        return response($kost, 201);
    }
}
