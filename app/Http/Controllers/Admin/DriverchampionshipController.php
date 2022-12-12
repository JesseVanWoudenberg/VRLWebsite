<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Driverchampionship;
use App\Models\Log;
use App\Models\Season;
use App\Models\Team;
use App\Models\Tier;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DriverchampionshipController extends Controller
{
    public function index(): View
    {
        User::checkPermissions("driverchampionship index");

        $driverchampionships = Driverchampionship::paginate();

        return view('private.driverchampionship.index', compact('driverchampionships'));
    }

    public function create(): View
    {
        User::checkPermissions("driverchampionship create");

        $drivers = Driver::all();
        $teams = Team::all();
        $seasons = Season::all();
        $tiers = Tier::all();

        return view('private.driverchampionship.create', compact('drivers', 'teams', 'seasons', 'tiers'));
    }

    public function store(Request $request): RedirectResponse
    {
        User::checkPermissions("driverchampionship create");
        $driverchampionship = new Driverchampionship();

        $driverchampionship->driver_id = $request->driver_id;
        $driverchampionship->team_id = $request->team_id;
        $driverchampionship->season_id = $request->season_id;
        $driverchampionship->tier_id = $request->tier_id;

        $driverchampionship->save();

        $log = new Log();
        $log->action = "Stored driverchampionship [ ID: " . $driverchampionship->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('driverchampionship')->with('status', 'driver championship successfully added');
    }

    public function show(Driverchampionship $driverchampionship): View
    {
        User::checkPermissions("driverchampionship show");

        return view('private.driverchampionship.show', compact('driverchampionship'));
    }

    public function edit(Driverchampionship $driverchampionship): View
    {
        User::checkPermissions("driverchampionship edit");

        $drivers = Driver::all();
        $teams = Team::all();
        $seasons = Season::all();
        $tiers = Tier::all();

        return view('private.driverchampionship.edit', compact('driverchampionship', 'drivers', 'teams', 'seasons', 'tiers'));
    }

    public function update(Request $request, Driverchampionship $driverchampionship): RedirectResponse
    {
        User::checkPermissions("driverchampionship edit");

        $driverchampionship->driver_id = $request->driver_id;
        $driverchampionship->team_id = $request->team_id;
        $driverchampionship->season_id = $request->season_id;
        $driverchampionship->tier_id = $request->tier_id;

        $driverchampionship->save();

        $log = new Log();
        $log->action = "Edited driverchampionship [ ID: " . $driverchampionship->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('driverchampionship')->with('status', 'driver championship successfully updated');
    }

    public function delete(Driverchampionship $driverchampionship): View
    {
        User::checkPermissions("driverchampionship delete");

        $drivers = Driver::all();
        $teams = Team::all();
        $seasons = Season::all();
        $tiers = Tier::all();

        return view('private.driverchampionship.delete', compact('driverchampionship', 'drivers', 'teams', 'seasons', 'tiers'));
    }

    public function destroy(Driverchampionship $driverchampionship): RedirectResponse
    {
        User::checkPermissions("driverchampionship delete");

        $driverchampionship->delete();

        $log = new Log();
        $log->action = "Deleted driverchampionship [ ID: " . $driverchampionship->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('driverchampionship')->with('status', 'driverchampionship successfully deleted');
    }
}
