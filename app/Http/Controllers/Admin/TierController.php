<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TierRequests\TierStoreRequest;
use App\Models\Tier;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TierController extends Controller
{
    public function index()
    {
        return view('private.tier.index', [
            'tiers' => DB::table('tiers')->paginate(20)
        ]);
    }

    public function create()
    {
        return view('private.tier.create');
    }

    public function store(TierStoreRequest $request)
    {
        $tier = new Tier();
        $tier->tiernumber = $request->tiernumber;
        $tier->save();
        return redirect()->route('tier')->with('status', 'tier successfully added');
    }

    public function delete(Tier $tier): View
    {
        return view('private.tier.delete', compact('tier'));
    }


    public function destroy(Tier $tier)
    {
        $tier->delete();
        return redirect()->route('tier')->with('status', 'Tier successfully deleted');
    }
}
