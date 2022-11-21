<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Penaltypoint;
use App\Models\Race;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PenaltypointController extends Controller
{
    public function index(): View
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("penaltypoint index")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        $drivers = Driver::all();

        foreach ($drivers as $driver)
        {
            $driverPenaltypoints = 0;

            foreach (Penaltypoint::all()->where('driver_id', '=', $driver->id) as $driverPenaltypoint)
            {
                $driverPenaltypoints += $driverPenaltypoint->amount;
            }

            $driver['amount'] = $driverPenaltypoints;
        }

        $penaltypoints = Penaltypoint::all();

        $drivers = $drivers->sortByDesc('amount');

        return view('private.penaltypoint.index', compact('drivers', 'penaltypoints'));
    }

    public function create(): View
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("penaltypoint create")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        $drivers = Driver::all();
        $races = Race::all();

        return view('private.penaltypoint.create', compact('drivers', 'races'));
    }

    public function store(Request $request): RedirectResponse
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("penaltypoint create")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        for ($i = 0; $i < $request->amount; $i++)
        {
            $penaltypoint = new Penaltypoint();
            $penaltypoint->driver_id = $request->driver_id;
            $penaltypoint->race_id = $request->race_id;
            $penaltypoint->amount = 1;
            $penaltypoint->save();
        }

        return redirect()->route('penaltypoint')->with('status', 'Penalty Point successfully created');
    }

    public function edit(Driver $driver): View
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("penaltypoint edit")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        $penaltypoints = Penaltypoint::all()->where('driver_id', '=', $driver->id);

        foreach ($penaltypoints as $penaltypoint)
        {
            $racesLeft = Race::query()
                ->select('races.id', 'races.round', 'races.season_id')
                ->whereIn('races.id',(function ($query) {
                    $query->from('racedrivers')
                        ->select('race_id')
                        ->where('race_id','=', DB::raw('races.id'));
                }))
                ->whereIn('races.season_id',(function ($query) use ($penaltypoint) {
                    $query->from('seasons')
                        ->select('season_id')
                        ->where('seasonnumber','>=', $penaltypoint->race->season->seasonnumber);
                }))
                ->where('races.round','>=', $penaltypoint->race->round)
                ->get()->count();

            $penaltypoint['racesleft'] = (11 - $racesLeft);
        }

        $penaltypoints = $penaltypoints->sortBy('racesleft');

        return view('private.penaltypoint.edit', compact('driver', 'penaltypoints'));
    }

    public function update(Request $request, Driver $driver): RedirectResponse
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo("penaltypoint edit")) {
                abort(403);
            }
        } else {
            abort(403);
        }

        foreach (Penaltypoint::all()->where('driver_id', '=', $driver->id) as $penaltypoint)
        {
            if ($request->has('penaltypoint-' . $penaltypoint->id))
            {
                $penaltypoint->delete();
            }
        }

        return redirect()->route('penaltypoint')->with('status', 'Penalty points successfully updated');
    }
}
