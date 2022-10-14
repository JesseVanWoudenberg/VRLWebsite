<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Tier;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index()
    {
        $seasons = Season::paginate(20);
        $tiers = Tier::all();

        return view('private.season.index', compact('seasons', 'tiers'));
    }

    public function create()
    {
        $tiers = Tier::all();

        return view('private.season.create', compact('tiers'));
    }

    public function store(Request $request)
    {
        $season = new Season();

        $season->seasonnumber = $request->seasonnumber;
        $season->tier_id = $request->tier_id;

        $season->save();

        return redirect()->route('season')->with('status', 'Season successfully created');
    }

    public function show(Season $season)
    {
        return view('private.season.show', compact('season'));
    }

    public function edit(Season $season)
    {
        $tiers = Tier::all();

        return view('private.season.edit', compact('season', 'tiers'));
    }

    public function update(Request $request, Season $season)
    {
        $season->seasonnumber = $request->seasonnumber;
        $season->tier_id = $request->tier_id;

        $season->save();

        return redirect()->route('season')->with('status', 'Season successfully updated');

    }

    public function delete(Season $season)
    {
        $tiers = Tier::all();

        return view('private.season.delete', compact('season', 'tiers'));
    }


    public function destroy(Season $season)
    {
        $season->delete();

        return redirect()->route('season')->with('status', 'Season successfully deleted');
    }
}
