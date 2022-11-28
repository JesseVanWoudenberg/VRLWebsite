<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Powerunit;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        User::checkPermissions("team index");

        $teams = Team::all();
        $powerunits = Powerunit::all();

        return view('private.team.index', compact('teams', 'powerunits'));
    }

    public function create()
    {
        User::checkPermissions("team create");

        $powerunits = Powerunit::all();
        return view('private.team.create', compact('powerunits'));
    }

    public function store(Request $request)
    {
        User::checkPermissions("team create");

        $team = new Team();

        $team->name = $request->name;
        $team->powerunit_id = $request->powerunit_id;

        $team->save();

        return redirect()->route('team')->with('status', 'Team successfully created');
    }

    public function show(Team $team)
    {
        User::checkPermissions("team show");

        $drivers = Driver::all()->where('team_id', $team->id);

        return view('private.team.show', compact('team', 'drivers'));
    }

    public function edit(Team $team)
    {
        User::checkPermissions("team edit");

        $powerunits = Powerunit::all();
        return view('private.team.edit', compact('team', 'powerunits'));
    }

    public function update(Request $request, Team $team)
    {
        User::checkPermissions("team edit");

        $team->name = $request->name;
        $team->powerunit_id = $request->powerunit_id;

        $team->save();

        return redirect()->route('team')->with('status', 'Team successfully updated');
    }

    public function delete(Team $team)
    {
        User::checkPermissions("team delete");

        return view('private.team.delete', compact('team'));
    }

    public function destroy(Team $team)
    {
        User::checkPermissions("team delete");

        $team->delete();

        return redirect()->route('team')->with('status', 'Team successfully deleted');
    }
}
