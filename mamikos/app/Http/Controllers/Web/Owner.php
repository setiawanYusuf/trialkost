<?php declare(strict_types=1);

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Kost;

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
        $kost = json_encode((object) []);
        $user = Auth::user()->toJson();
        $config = json_encode([
            'label' => 'Add New Kost',
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

    public function edit($id): \Illuminate\Contracts\Support\Renderable
    {
        $kost = Kost::find($id)->toJson();
        $user = Auth::user()->toJson();
        $config = json_encode([
            'label' => 'Edit Kost',
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
