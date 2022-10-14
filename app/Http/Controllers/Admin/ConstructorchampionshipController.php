<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Constructorchampionship;
use App\Models\Driver;
use App\Models\Season;
use App\Models\Team;
use App\Models\Tier;
use Illuminate\Http\Request;

class ConstructorchampionshipController extends Controller
{
    public function index()
    {
        $constructorchampionships = Constructorchampionship::paginate();

        return view('private.constructorchampionship.index', compact('constructorchampionships'));
    }

    public function create()
    {
        $teams = Team::all();
        $seasons = Season::all();

        return view('private.constructorchampionship.create', compact('teams', 'seasons'));
    }

    public function store(Request $request)
    {
        $constructorchampionship = new Constructorchampionship();

        $constructorchampionship->team_id = $request->team_id;
        $constructorchampionship->season_id = $request->season_id;
        $constructorchampionship->tier_id = $constructorchampionship->season->tier->id;

        $constructorchampionship->save();

        return redirect()->route('constructorchampionship')->with('status', 'Constructor championship successfully added');
    }

    public function show(Constructorchampionship $constructorchampionship)
    {
        return view('private.constructorchampionship.show', compact('constructorchampionship'));
    }

    public function edit(Constructorchampionship $constructorchampionship)
    {
        $teams = Team::all();
        $seasons = Season::all();

        return view('private.constructorchampionship.edit', compact('constructorchampionship', 'teams', 'seasons'));
    }

    public function update(Request $request, Constructorchampionship $constructorchampionship)
    {
        $constructorchampionship->team_id = $request->team_id;
        $constructorchampionship->season_id = $request->season_id;
        $constructorchampionship->tier_id = $constructorchampionship->season->tier_id;

        $constructorchampionship->save();

        return redirect()->route('constructorchampionship')->with('status', 'Constructor championship successfully updated');


    }

    public function delete(Constructorchampionship $constructorchampionship)
    {
        $teams = Team::all();
        $seasons = Season::all();

        return view('private.constructorchampionship.delete', compact('constructorchampionship', 'teams', 'seasons'));
    }

    public function destroy(Constructorchampionship $constructorchampionship)
    {
        $constructorchampionship->delete();

        return redirect()->route('constructorchampionship')->with('status', 'Constructor championship successfully deleted');
    }
}
