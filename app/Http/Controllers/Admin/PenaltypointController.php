<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
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
                    ->where('raceformats.format','=','full');
            }))
            ->orderBy('races.season_id','desc')
            ->orderBy('races.round','desc')
            ->limit(10)
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

        return redirect()->route('penaltypoint')->with('status', 'Penalty Point successfully created');
    }

    public function edit(Driver $driver): View
    {
        User::checkPermissions("penaltypoint edit");

        $penaltypoints = Penaltypoint::all()->where('driver_id', '=', $driver->id);

        foreach ($penaltypoints as $penaltypoint)
        {
            $racesLeft = Race::query()
                ->select('races.*', 'seasons.seasonnumber')
                ->join('seasons','races.season_id','=','seasons.id')
                ->whereIn('races.tier_id', (function ($query) {
                    $query->from('tiers')
                        ->select('tiers.id')
                        ->where('tiers.tiernumber','=',1);
                }))
                ->whereIn('races.raceformat_id', (function ($query) {
                    $query->from('raceformats')
                        ->select('raceformats.id')
                        ->where("raceformats.format", "=", 'full')
                        ->orWhere("raceformats.format", "=", 'preseason');
                }))
                ->whereIn('races.id',(function ($query) {
                    $query->from('racedrivers')
                        ->select('racedrivers.race_id')
                        ->where('racedrivers.race_id','=', DB::raw('races.id'));
                }))
                ->whereRaw("
                    CASE WHEN seasonnumber = " . $penaltypoint->race->season->seasonnumber . " THEN
                        IF(races.round >= " . $penaltypoint->race->round . ", TRUE, FALSE)
                    WHEN seasonnumber < " . $penaltypoint->race->season->seasonnumber . " THEN FALSE
                    WHEN seasonnumber > " . $penaltypoint->race->season->seasonnumber . " THEN TRUE
                    END
                ")
                ->orderBy('seasons.seasonnumber','desc')
                ->orderBy('races.round','desc')
                ->get()->count();

            $penaltypoint['racesleft'] = (11 - $racesLeft);

            if ($racesLeft > 10)
            {
                $penaltypoint['racesleft'] = 0;
            }
        }

        $penaltypoints = $penaltypoints->sortBy('racesleft');

        return view('private.penaltypoint.edit', compact('driver', 'penaltypoints'));
    }

    public function update(Request $request, Driver $driver): RedirectResponse
    {
        User::checkPermissions("penaltypoint edit");

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
