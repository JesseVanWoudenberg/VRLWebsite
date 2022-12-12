<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Constructorchampionship;
use App\Models\Driver;
use App\Models\Log;
use App\Models\Season;
use App\Models\Team;
use App\Models\Tier;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ConstructorchampionshipController extends Controller
{
    public function index(): View
    {
        User::checkPermissions("constructorchampionship index");

        $constructorchampionships = Constructorchampionship::paginate();

        return view('private.constructorchampionship.index', compact('constructorchampionships'));
    }

    public function create(): View
    {
        User::checkPermissions("constructorchampionship create");

        $teams = Team::all();
        $seasons = Season::all();

        return view('private.constructorchampionship.create', compact('teams', 'seasons'));
    }

    public function store(Request $request): RedirectResponse
    {
        User::checkPermissions("constructorchampionship create");

        $constructorchampionship = new Constructorchampionship();

        $constructorchampionship->team_id = $request->team_id;
        $constructorchampionship->season_id = $request->season_id;
        $constructorchampionship->tier_id = $constructorchampionship->season->tier->id;

        $constructorchampionship->save();

        $log = new Log();
        $log->action = "Stored constructorchampionship [ ID: " . $constructorchampionship->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('constructorchampionship')->with('status', 'Constructor championship successfully added');
    }

    public function show(Constructorchampionship $constructorchampionship): View
    {
        User::checkPermissions("constructorchampionship show");

        return view('private.constructorchampionship.show', compact('constructorchampionship'));
    }

    public function edit(Constructorchampionship $constructorchampionship): View
    {
        User::checkPermissions("constructorchampionship edit");

        $teams = Team::all();
        $seasons = Season::all();

        return view('private.constructorchampionship.edit', compact('constructorchampionship', 'teams', 'seasons'));
    }

    public function update(Request $request, Constructorchampionship $constructorchampionship): RedirectResponse
    {
        User::checkPermissions("constructorchampionship edit");

        $constructorchampionship->team_id = $request->team_id;
        $constructorchampionship->season_id = $request->season_id;
        $constructorchampionship->tier_id = $constructorchampionship->season->tier_id;

        $constructorchampionship->save();

        $log = new Log();
        $log->action = "Edited constructorchampionship [ ID: " . $constructorchampionship->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('constructorchampionship')->with('status', 'Constructor championship successfully updated');


    }

    public function delete(Constructorchampionship $constructorchampionship): View
    {
        User::checkPermissions("constructorchampionship delete");

        $teams = Team::all();
        $seasons = Season::all();

        return view('private.constructorchampionship.delete', compact('constructorchampionship', 'teams', 'seasons'));
    }

    public function destroy(Constructorchampionship $constructorchampionship): RedirectResponse
    {
        User::checkPermissions("constructorchampionship delete");

        $constructorchampionship->delete();

        $log = new Log();
        $log->action = "Deleted constructorchampionship [ ID: " . $constructorchampionship->id . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('constructorchampionship')->with('status', 'Constructor championship successfully deleted');
    }
}
