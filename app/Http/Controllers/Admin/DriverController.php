<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Log;
use App\Models\Team;
use App\Models\Tier;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DriverController extends Controller
{
    public function index(): View
    {
        User::checkPermissions("driver index");

        $drivers = Driver::orderBy('name', 'asc')->paginate(10);

        return view('private.driver.index', compact('drivers'));
    }

    public function create(): View
    {
        User::checkPermissions("driver create");

        $teams = Team::all();
        $tiers = Tier::all();

        return view('private.driver.create', compact('teams', 'tiers'));
    }

    public function store(Request $request): RedirectResponse
    {
        User::checkPermissions("driver create");

        $driver = new Driver();

        $driver->name = $request->name;
        $driver->drivernumber = $request->drivernumber;
        $driver->nationality = $request->nationality;
        $driver->team_id = $request->team_id;
        $driver->tier_id = $request->tier_id;

        $driver->save();

        $log = new Log();
        $log->action = "Stored driver [ ID: " . $driver->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('driver')->with('status', 'Driver successfully created');
    }

    public function show(Driver $driver): View
    {
        User::checkPermissions("driver show");

        return view('private.driver.show', compact('driver'));
    }

    public function edit(Driver $driver): View
    {
        User::checkPermissions("driver edit");

        $teams = Team::all();
        $tiers = Tier::all();

        return view('private.driver.edit', compact('driver', 'teams', 'tiers'));
    }

    public function update(Request $request, Driver $driver): RedirectResponse
    {
        User::checkPermissions("driver edit");

        $driver->name = $request->name;
        $driver->nationality = $request->nationality;
        $driver->drivernumber = $request->drivernumber;
        $driver->team_id = $request->team_id;
        $driver->tier_id = $request->tier_id;

        $driver->save();

        $log = new Log();
        $log->action = "Edited driver [ ID: " . $driver->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('driver')->with('status', 'Driver successfully updated');
    }

    public function delete(Driver $driver): View
    {
        User::checkPermissions("driver delete");

        $teams = Team::all();
        $tiers = Tier::all();

        return view('private.driver.delete', compact('driver', 'teams', 'tiers'));
    }

    public function destroy(Driver $driver): RedirectResponse
    {
        User::checkPermissions("driver delete");

        $driver->delete();

        $log = new Log();
        $log->action = "Deleted driver [ ID: " . $driver->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('driver')->with('status', 'Driver successfully deleted');
    }
}
