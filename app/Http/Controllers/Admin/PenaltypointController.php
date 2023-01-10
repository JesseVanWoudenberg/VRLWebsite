<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\ExpiredPenaltypoint;
use App\Models\Log;
use App\Models\Penaltypoint;
use App\Models\Race;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PenaltypointController extends Controller
{
    public function index(): View
    {
        User::checkPermissions("penaltypoint index");

        $drivers = Driver::query()
            ->select('*')
            ->whereIn('drivers.id',(function ($query) {
                $query->from('penaltypoints')
                    ->select('driver_id')
                    ->where('driver_id','=', DB::raw('drivers.id'));
            }))
            ->get();

        foreach ($drivers as $driver)
        {
            $driverPenaltypoints = 0;
            $driver['expired'] = 0;

            foreach (Penaltypoint::all()->where('driver_id', '=', $driver->id) as $driverPenaltypoint)
            {
                $driverPenaltypoints += $driverPenaltypoint->amount;

                if (Penaltypoint::getRacesLeft($driverPenaltypoint) >= 10)
                {
                    $driver['expired'] += 1;
                }
            }

            $driver['amount'] = $driverPenaltypoints;
        }

        $penaltypoints = Penaltypoint::all();

        $drivers = $drivers->sortByDesc('amount');

        return view('private.penaltypoint.index', compact('drivers', 'penaltypoints'));
    }

    public function create(): View
    {
        User::checkPermissions("penaltypoint create");

        $drivers = Driver::all();
        $races = Race::query()
            ->select('*')
            ->whereIn('races.id', (function ($query) {
                $query->from('racedrivers')
                    ->select('race_id')
                    ->where('race_id', '=', DB::raw('races.id'));
            }))
            ->whereIn('races.raceformat_id', (function ($query) {
                $query->from('raceformats')
                    ->select('id')
                    ->where('raceformats.format','=','full')
                    ->orWhere("raceformats.format", "=", 'preseason');
            }))
            ->orderBy('races.season_id','desc')
            ->orderBy('races.round','desc')
            ->limit(15)
            ->get();

        return view('private.penaltypoint.create', compact('drivers', 'races'));
    }

    public function store(Request $request): RedirectResponse
    {
        User::checkPermissions("penaltypoint create");

        for ($i = 0; $i < $request->amount; $i++)
        {
            $penaltypoint = new Penaltypoint();
            $penaltypoint->driver_id = $request->driver_id;
            $penaltypoint->race_id = $request->race_id;
            $penaltypoint->amount = 1;

            $penaltypoint->save();

        }

        $log = new Log();
        $log->action = "Added " . $request->amount . " penaltypoint(s) to [ DriverID: " . $request->driver_id . " Driver name: " . Driver::all()->where('id', '=', $request->driver_id)->first()->name . " ]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('penaltypoint')->with('status', 'Penalty Point successfully created');
    }

    public function edit(Driver $driver): View
    {
        User::checkPermissions("penaltypoint edit");

        $penaltypoints = Penaltypoint::all()->where('driver_id', '=', $driver->id);

        foreach ($penaltypoints as $penaltypoint)
        {
            Penaltypoint::getRacesLeft($penaltypoint);
        }

        $penaltypoints = $penaltypoints->sortBy('racesleft');

        return view('private.penaltypoint.edit', compact('driver', 'penaltypoints'));
    }

    public function update(Request $request, Driver $driver): RedirectResponse
    {
        User::checkPermissions("penaltypoint edit");

        $penaltypointCount = Penaltypoint::all()->where('driver_id', '=', $driver->id)->count();

        foreach (Penaltypoint::all()->where('driver_id', '=', $driver->id) as $penaltypoint)
        {
            if ($request->has('penaltypoint-' . $penaltypoint->id))
            {
                $expired_penaltypoint = new ExpiredPenaltypoint();
                $expired_penaltypoint->driver_id = $penaltypoint->driver_id;
                $expired_penaltypoint->race_id = $penaltypoint->race_id;
                $expired_penaltypoint->amount = 1;
                $expired_penaltypoint->save();

                $penaltypoint->delete();
            }
        }

        $log = new Log();
        $log->action = "Changed penaltypoint(s) from " . $penaltypointCount . " To " . Penaltypoint::all()->where('driver_id', '=', $driver->id)->count() . " [ DriverID: " . $driver->id . " Driver name: " . $driver->name . " ]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('penaltypoint')->with('status', 'Penalty points successfully updated');
    }
}
