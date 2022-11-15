<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Fastestlap;
use App\Models\Qualifyingdriver;
use App\Models\Race;
use App\Models\Racedriver;
use App\Models\Raceformat;
use App\Models\Season;
use App\Models\Shortqualifyingdriver;
use App\Models\Team;
use App\Models\Tier;
use App\Models\Track;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    public function getAssociatedFastestLap(Race $race)
    {
        return Fastestlap::all()
            ->where('race_id', $race->id)
            ->first();
    }

    public function getAssociatedFullQualifyingDrivers(Race $race): Collection
    {
        return Qualifyingdriver::all()
            ->where('race_id', $race->id)
            ->sortBy('q3');
    }

    public function getAssociatedShortQualifyingDrivers(Race $race): Collection
    {
        return Shortqualifyingdriver::all()
            ->where('race_id', $race->id)
            ->sortBy('position');
    }

    public function getAssociatedDrivers(Race $race): Collection
    {
        return Racedriver::all()
            ->where('race_id', $race->id)
            ->sortBy('position');
    }

    public function createDriversRows($request, $race)
    {
        for ($i = 1; $i <= 20; $i++)
        {
            if ($request->input("driver" . $i) != "none")
            {
                $racedriver[$i] = new Racedriver();
                $racedriver[$i]->position = $i;
                $racedriver[$i]->race_id = $race->id;
                $racedriver[$i]->driver_id = $request->input("driver" . $i);
                $racedriver[$i]->team_id = $request->input("team" . $i);

                if ($request->has('dnf' . $i)) {
                    $racedriver[$i]->dnf = 1;
                } else {
                    $racedriver[$i]->dnf = 0;
                }

                $racedriver[$i]->save();

                // Full or Short Qualifying check
                if ($request->input("full-driver-1") != "none") {

                    // Adding Full Qualifying drivers
                    if ($request->input("full-driver-" . $i) != "none") {

                        $qualifying[$i] = new Qualifyingdriver();

                        $qualifying[$i]->race_id = $race->id;
                        $qualifying[$i]->driver_id = $request->input("full-driver-" . $i);
                        $qualifying[$i]->team_id = $request->input("full-team-" . $i);

                        $qualifying[$i]->q1 = $request->input("full-Q1-" . $i);
                        $qualifying[$i]->q2 = $request->input("full-Q2-" . $i);
                        $qualifying[$i]->q3 = $request->input("full-Q3-" . $i);
                        $qualifying[$i]->q1laptime = $request->input("full-q1-time-" . $i);
                        $qualifying[$i]->q2laptime = $request->input("full-q2-time-" . $i);
                        $qualifying[$i]->q3laptime = $request->input("full-q3-time-" . $i);
                        $qualifying[$i]->q1tyre = $request->input("full-q1tyre-" . $i);
                        $qualifying[$i]->q2tyre = $request->input("full-q2tyre-" . $i);
                        $qualifying[$i]->q3tyre = $request->input("full-q3tyre-" . $i);

                        $qualifying[$i]->save();
                    }
                }
                else
                {
                    // Adding Short Qualifying drivers
                    if ($request->input("short-driver-" . $i) != "none") {

                        $shortqualifying[$i] = new Shortqualifyingdriver();

                        $shortqualifying[$i]->race_id = $race->id;
                        $shortqualifying[$i]->driver_id = $request->input("short-driver-" . $i);
                        $shortqualifying[$i]->team_id = $request->input("short-team-" . $i);

                        $shortqualifying[$i]->position = $i;
                        $shortqualifying[$i]->laptime = $request->input("short-laptime-" . $i);
                        $shortqualifying[$i]->tyre = $request->input("short-tyre-" . $i);

                        $shortqualifying[$i]->save();
                    }
                }

                if ($request->input("driver" . $i) == $request->input("fastest-lap-driver"))
                {
                    $fastestlap = new Fastestlap();
                    $fastestlap->laptime = $request->input("fastest-lap-time");
                    $fastestlap->race_id = $race->id;
                    $fastestlap->driver_id = $request->input("fastest-lap-driver");
                    $fastestlap->team_id = $request->input("fastest-lap-team");
                    $fastestlap->save();
                }
            }
        }
    }

    public function index(): View
    {
        $races = Race::all()->sortBy('round')->sortBy('season_id');

        return view('private.race.index', compact('races'));
    }

    public function create(): View
    {
        $tracks = Track::all();
        $seasons = Season::all();
        $tiers = Tier::all();
        $drivers = Driver::all()->sortBy('name');
        $teams = Team::all();
        $raceformats = Raceformat::all();

        return view('private.race.create', compact('tracks', 'seasons', 'drivers', 'tiers', 'raceformats', 'teams'));
    }

    public function show(Race $race): View
    {
        $race_drivers = $this->getAssociatedDrivers($race);
        $fastestlap = $this->getAssociatedFastestLap($race);

        if ($this->getAssociatedFullQualifyingDrivers($race)->count() > 0)
        {
            $fullqualifyingdrivers = $this->getAssociatedFullQualifyingDrivers($race);

            return view('private.race.show', compact('race', 'race_drivers', 'fastestlap', 'fullqualifyingdrivers'));
        }
        else
        {
            $shortqualifyingdrivers = $this->getAssociatedShortQualifyingDrivers($race);

            return view('private.race.show', compact('race', 'race_drivers', 'fastestlap', 'shortqualifyingdrivers'));
        }
    }

    public function edit(Race $race): View
    {
        $tracks = Track::all();
        $seasons = Season::all();
        $tiers = Tier::all();
        $drivers = Driver::all()->sortBy('name');
        $teams = Team::all();
        $raceformats = Raceformat::all();
        $fastestlap = $this->getAssociatedFastestLap($race);
        $racedrivers = $this->getAssociatedDrivers($race);
        $shortqualifyingdrivers = $this->getAssociatedShortQualifyingDrivers($race);
        $fullqualifyingdrivers = $this->getAssociatedFullQualifyingDrivers($race);

        return view('private.race.edit', compact('racedrivers', 'race', 'teams', 'tracks', 'seasons', 'drivers', 'tiers', 'raceformats', 'fastestlap', 'shortqualifyingdrivers', 'fullqualifyingdrivers'));
    }

    public function delete(Race $race): View
    {
        $race_drivers = $this->getAssociatedDrivers($race);
        $fastestlap = $this->getAssociatedFastestLap($race);

        if ($this->getAssociatedFullQualifyingDrivers($race)->count() > 0)
        {
            $fullqualifyingdrivers = $this->getAssociatedFullQualifyingDrivers($race);

            return view('private.race.delete', compact('race', 'race_drivers', 'fastestlap', 'fullqualifyingdrivers'));
        }
        else
        {
            $shortqualifyingdrivers = $this->getAssociatedShortQualifyingDrivers($race);

            return view('private.race.delete', compact('race', 'race_drivers', 'fastestlap', 'shortqualifyingdrivers'));
        }
    }

    public function destroy(Race $race)
    {
        $race->delete();

        return redirect()->route('race')->with('status', 'Race successfully removed');
    }

    public function update(Request $request, Race $race): RedirectResponse
    {
        $fastestlap = $this->getAssociatedFastestLap($race);
        $race_drivers = $this->getAssociatedDrivers($race);
        $shortqualifyingdrivers = $this->getAssociatedShortQualifyingDrivers($race);
        $fullqualifyingdrivers = $this->getAssociatedFullQualifyingDrivers($race);

        foreach ($race_drivers as $race_driver)
        {
            $race_driver->delete();
        }
        foreach ($shortqualifyingdrivers as $shortqualifyingdriver)
        {
            $shortqualifyingdriver->delete();
        }
        foreach ($fullqualifyingdrivers as $fullqualifyingdriver)
        {
            $fullqualifyingdriver->delete();
        }
        if (isset($fastestlap))
        {
            $fastestlap->delete();
        }

        $race->track_id = $request->track_id;
        $race->season_id = $request->season_id;
        $race->tier_id = $race->season->tier_id;
        $race->raceformat_id = $request->raceformat_id;
        $race->round = $request->round;

        $race->save();

        $this->createDriversRows($request, $race);

        return redirect()->route('race')->with('status', 'Race successfully updated');
    }

    public function store(Request $request): RedirectResponse
    {
        $race = new Race();

        $race->track_id = $request->track_id;
        $race->season_id = $request->season_id;
        $race->tier_id = $race->season->tier_id;
        $race->raceformat_id = $request->raceformat_id;
        $race->round = $request->round;

        $race->save();

        $this->createDriversRows($request, $race);

        return redirect()->route('race')->with('status', 'Race successfully created');
    }
}
