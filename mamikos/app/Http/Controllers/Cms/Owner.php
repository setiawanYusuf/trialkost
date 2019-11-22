<?php declare(strict_types=1);

namespace App\Http\Controllers\Cms;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class Owner extends Controller
{
    //protected $guards = 'web';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function add(): \Illuminate\Contracts\Support\Renderable
    {
        $user = Auth::user()->toJson();
        $config = json_encode([
            'label' => 'Add New Kost',
        ]);

        return view(
            'dashboard/owner/add',
            compact(
                'user',
                'config'
            )
        );
    }
}
