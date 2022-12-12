<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TierRequests\TierStoreRequest;
use App\Models\Log;
use App\Models\Tier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TierController extends Controller
{
    public function index()
    {
        User::checkPermissions("tier index");

        return view('private.tier.index', [
            'tiers' => DB::table('tiers')->paginate(20)
        ]);
    }

    public function create()
    {
        User::checkPermissions("tier create");

        return view('private.tier.create');
    }

    public function store(TierStoreRequest $request)
    {
        User::checkPermissions("tier create");

        $tier = new Tier();
        $tier->tiernumber = $request->tiernumber;

        $tier->save();

        $log = new Log();
        $log->action = "Stored tier [ ID: " . $tier->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('tier')->with('status', 'tier successfully added');
    }

    public function delete(Tier $tier): View
    {
        User::checkPermissions("tier delete");

        return view('private.tier.delete', compact('tier'));
    }


    public function destroy(Tier $tier)
    {
        User::checkPermissions("tier delete");

        $tier->delete();

        $log = new Log();
        $log->action = "Deleted tier [ ID: " . $tier->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('tier')->with('status', 'Tier successfully deleted');
    }
}
