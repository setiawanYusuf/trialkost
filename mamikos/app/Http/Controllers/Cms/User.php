<?php declare(strict_types=1);

namespace App\Http\Controllers\Cms;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class User extends Controller
{
    //protected $guards = 'web';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
}
