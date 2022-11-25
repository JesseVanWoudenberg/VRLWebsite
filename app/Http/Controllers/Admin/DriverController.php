<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Team;
use App\Models\Tier;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::orderBy('name', 'asc')->paginate(10);

        return view('private.driver.index', compact('drivers'));
    }

    public function create()
    {
        $teams = Team::all();
        $tiers = Tier::all();

        return view('private.driver.create', compact('teams', 'tiers'));
    }

    public function store(Request $request)
    {
        $driver = new Driver();

        $driver->name = $request->name;
        $driver->drivernumber = $request->drivernumber;
        $driver->nationality = $request->nationality;
        $driver->team_id = $request->team_id;
        $driver->tier_id = $request->tier_id;

        $driver->save();

        return redirect()->route('driver')->with('status', 'Driver successfully added');
    }

    public function show(Driver $driver)
    {
        return view('private.driver.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        $teams = Team::all();
        $tiers = Tier::all();

        return view('private.driver.edit', compact('driver', 'teams', 'tiers'));
    }

    public function update(Request $request, Driver $driver)
    {
        $driver->name = $request->name;
        $driver->nationality = $request->nationality;
        $driver->drivernumber = $request->drivernumber;
        $driver->team_id = $request->team_id;
        $driver->tier_id = $request->tier_id;

        $driver->save();

        return redirect()->route('driver')->with('status', 'Driver successfully updated');
    }

    public function delete(Driver $driver)
    {
        $teams = Team::all();
        $tiers = Tier::all();

        return view('private.driver.delete', compact('driver', 'teams', 'tiers'));
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('driver')->with('status', 'Driver successfully deleted');
    }
}
