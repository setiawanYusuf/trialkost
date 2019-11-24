<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User as UserModel;

class User extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {}

    /**
     * Update specified kost
     */
    public function minusCreditPoint(Request $request): Response
    {
        $user = UserModel::find($request->idUser);
        if ($user->credit_point) {
            $user->credit_point = ($user->credit_point - 5);
            $user->save();
        }

        return response(
            $user,
            200
        );
    }
}
