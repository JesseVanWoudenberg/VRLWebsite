<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Powerunit;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        $powerunits = Powerunit::all();

        return view('private.team.index', compact('teams', 'powerunits'));
    }

    public function create()
    {
        $powerunits = Powerunit::all();
        return view('private.team.create', compact('powerunits'));
    }

    public function store(Request $request)
    {
        $team = new Team();

        $team->name = $request->name;
        $team->powerunit_id = $request->powerunit_id;

        $team->save();

        return redirect()->route('team')->with('status', 'Team successfully created');
    }

    public function show(Team $team)
    {
        return view('private.team.show', compact('team'));
    }

    public function edit(Team $team)
    {
        $powerunits = Powerunit::all();
        return view('private.team.edit', compact('team', 'powerunits'));
    }

    public function update(Request $request, Team $team)
    {
        $team->name = $request->name;
        $team->powerunit_id = $request->powerunit_id;

        $team->save();

        return redirect()->route('team')->with('status', 'Team successfully updated');
    }

    public function delete(Team $team)
    {
        return view('private.team.delete', compact('team'));
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('team')->with('status', 'Team successfully deleted');
    }
}
