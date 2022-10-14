<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Driverchampionship;
use App\Models\Season;
use App\Models\Team;
use App\Models\Tier;
use Illuminate\Http\Request;

class DriverchampionshipController extends Controller
{
    public function index()
    {
        $driverchampionships = Driverchampionship::paginate();

        return view('private.driverchampionship.index', compact('driverchampionships'));
    }

    public function create()
    {
        $drivers = Driver::all();
        $teams = Team::all();
        $seasons = Season::all();
        $tiers = Tier::all();

        return view('private.driverchampionship.create', compact('drivers', 'teams', 'seasons', 'tiers'));
    }

    public function store(Request $request)
    {
        $driverchampionship = new Driverchampionship();

        $driverchampionship->driver_id = $request->driver_id;
        $driverchampionship->team_id = $request->team_id;
        $driverchampionship->season_id = $request->season_id;
        $driverchampionship->tier_id = $request->tier_id;

        $driverchampionship->save();

        return redirect()->route('driverchampionship')->with('status', 'driver championship successfully added');
    }

    public function show(Driverchampionship $driverchampionship)
    {
        return view('private.driverchampionship.show', compact('driverchampionship'));
    }

    public function edit(Driverchampionship $driverchampionship)
    {
        $drivers = Driver::all();
        $teams = Team::all();
        $seasons = Season::all();
        $tiers = Tier::all();

        return view('private.driverchampionship.edit', compact('driverchampionship', 'drivers', 'teams', 'seasons', 'tiers'));
    }

    public function update(Request $request, Driverchampionship $driverchampionship)
    {
        $driverchampionship->driver_id = $request->driver_id;
        $driverchampionship->team_id = $request->team_id;
        $driverchampionship->season_id = $request->season_id;
        $driverchampionship->tier_id = $request->tier_id;

        $driverchampionship->save();

        return redirect()->route('driverchampionship')->with('status', 'driver championship successfully updated');
    }

    public function delete(Driverchampionship $driverchampionship)
    {
        $drivers = Driver::all();
        $teams = Team::all();
        $seasons = Season::all();
        $tiers = Tier::all();

        return view('private.driverchampionship.delete', compact('driverchampionship', 'drivers', 'teams', 'seasons', 'tiers'));
    }

    public function destroy(Driverchampionship $driverchampionship)
    {
        $driverchampionship->delete();

        return redirect()->route('driverchampionship')->with('status', 'driverchampionship successfully deleted');
    }
}
