<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Powerunit;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PowerunitController extends Controller
{
    public function index(): View
    {
        User::checkPermissions("powerunit index");

        return view('private.powerunit.index',[
            'powerunits' => DB::table('powerunits')->paginate(10)
        ]);
    }

    public function create(): View
    {
        User::checkPermissions("powerunit create");

        return view('private.powerunit.create');
    }

    public function store(Request $request): RedirectResponse
    {
        User::checkPermissions("powerunit create");

        $powerunit = new Powerunit();
        $powerunit->name = $request->name;

        $powerunit->save();

        $log = new Log();
        $log->action = "Stored powerunit [ ID: " . $powerunit->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('powerunit')->with('status', 'Power unit successfully added');
    }

    public function show(Powerunit $powerunit): View
    {
        User::checkPermissions("powerunit show");

        return view('private.powerunit.show', compact('powerunit'));
    }

    public function edit(Powerunit $powerunit): View
    {
        User::checkPermissions("powerunit edit");

        return view('private.powerunit.edit', compact('powerunit'));
    }

    public function update(Request $request, Powerunit $powerunit): RedirectResponse
    {
        User::checkPermissions("powerunit edit");

        $powerunit->name = $request->name;

        $powerunit->save();

        $log = new Log();
        $log->action = "Edited powerunit [ ID: " . $powerunit->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('powerunit')->with('status', 'Power unit successfully updated');
    }

    public function delete(Powerunit $powerunit): View
    {
        User::checkPermissions("powerunit delete");

        return view('private.powerunit.delete', compact('powerunit'));
    }

    public function destroy(Powerunit $powerunit): RedirectResponse
    {
        User::checkPermissions("powerunit delete");

        $powerunit->delete();

        $log = new Log();
        $log->action = "Deleted powerunit [ ID: " . $powerunit->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('powerunit')->with('status', 'Power unit successfully deleted');
    }
}
