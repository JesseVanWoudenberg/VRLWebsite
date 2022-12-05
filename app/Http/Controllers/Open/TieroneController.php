<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Driverchampionship;
use App\Models\Fastestlap;
use App\Models\Qualifyingdriver;
use App\Models\Race;
use App\Models\Racedriver;
use App\Models\Season;
use App\Models\Shortqualifyingdriver;
use App\Models\Team;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TieroneController extends Controller
{

    public function calculateTotalDriverPoints(Driver $driver): int
    {
        $points = 0;

        $racedrivers = Racedriver::query()
            ->select('driver_id', 'dnf', 'race_id', 'position')
            ->whereIn('racedrivers.race_id',(function ($query) {
                $query->from('races')
                    ->select('races.id')
                    ->whereIn('races.tier_id',(function ($query) {
                        $query->from('tiers')
                            ->select('tiers.id')
                            ->where('tiernumber', '=', 1);
                    }));
            }))
            ->where('racedrivers.dnf','=',0)
            ->where('driver_id', '=', $driver->id)
            ->where('position', '<', '11')
            ->get();

        foreach ($racedrivers as $racedriver) {

            if ($racedriver->race->raceformat->format == "full") {
                $points += match (intval($racedriver->position)) {
                    1 => 25,
                    2 => 18,
                    3 => 15,
                    4 => 12,
                    5 => 10,
                    6 => 8,
                    7 => 6,
                    8 => 4,
                    9 => 2,
                    10 => 1,
                    default => 0,
                };

                if (Fastestlap::all()->where('driver_id', $driver->id)->where('race_id', $racedriver->race->id)->where('position', '<=', 10)->count() > 0) {
                    $points++;
                }

            } elseif ($racedriver->race->raceformat->format == "sprint") {

                if (intval($racedriver->position) < 9) {

                    $points += 9 - intval($racedriver->position);

                }
            }
        }

        return $points;
    }

    public function calculateSeasonDriversPoints(): Collection
    {
        // New collection for the driver points in "season arrays" in a collection
        $allSeasons = collect();

        $seasons = Season::all()->where('tier_id', 1);

        foreach ($seasons as $season)
        {
            // New collection for season results
            $driverSeason = collect();

//            $drivers = Driver::all();

            $drivers = Driver::query()
                ->select('id', 'name', 'team_id')
                ->whereExists(function ($query) use ($season) {
                    $query->from('racedrivers')
                        ->select('driver_id')
                        ->where('driver_id','=',DB::raw('drivers.id'))
                        ->whereIn('race_id',(function ($query) use ($season) {
                            $query->from('races')
                                ->select('id')
                                ->where('season_id','=', $season->id);
                        }));
                })
                ->get();

            foreach ($drivers as $driver)
            {
                // Models
                $racedrivers = Racedriver::query()
                    ->select('driver_id', 'dnf', 'race_id', 'position')
                    ->whereIn('racedrivers.race_id',(function ($query) use ($season) {

                        $query->from('races')
                            ->select('races.id')
                            ->whereIn('races.tier_id',(function ($query) {
                                $query->from('tiers')
                                    ->select('tiers.id')
                                    ->where('tiernumber','=',1);
                            }))->whereIn('races.season_id',(function ($query) use ($season) {
                                $query->from('seasons')
                                    ->select('seasons.id')
                                    ->where('seasonnumber','=', $season->seasonnumber);
                            }));
                    }))
                    ->where('driver_id', '=', $driver->id)
                    ->where('dnf', '=', '0')
                    ->where('position', '<', '11')
                    ->get();

                // Adding points to driver
                $points = 0;

                foreach ($racedrivers as $racedriver)
                {
                    if ($racedriver->race->raceformat->format == "full")
                    {
                        $points += match (intval($racedriver->position))
                        {
                            1 => 25,
                            2 => 18,
                            3 => 15,
                            4 => 12,
                            5 => 10,
                            6 => 8,
                            7 => 6,
                            8 => 4,
                            9 => 2,
                            10 => 1,
                            default => 0,
                        };

                        if (Fastestlap::all()->where('driver_id', $driver->id)->where('race_id', $racedriver->race->id)->count() > 0)
                        {
                            $points++;
                        }

                    } elseif ($racedriver->race->raceformat->format == "sprint") {

                        if (intval($racedriver->position) < 9) {

                            $points += 9 - intval($racedriver->position);

                        }
                    }
                }

                $driver['points'] = $points;

                $driverSeason->add($driver);
                $driverSeason = $driverSeason->sortByDesc('points');

            }

            $allSeasons->put($season->seasonnumber, $driverSeason);

        }

        return $allSeasons;

    }

    private function calculateTeamsPoints()
    {
//      New collection for the teams points in "season arrays" in a collection
        $allSeasons = collect();

        $seasons = Season::all()->where('tier_id', 1);

        foreach ($seasons as $season)
        {

            // New collection for season results
            $teamSeason = collect();

            $teams = Team::all();

            foreach ($teams as $team)
            {
                $points = 0;

                // Racedriver models
                $racedrivers = Racedriver::query()
                    ->select('driver_id', 'dnf', 'race_id', 'position', 'team_id')
                    ->whereIn('racedrivers.race_id',(function ($query) use ($season) {
                        $query->from('races')
                            ->select('races.id')
                            ->whereIn('races.tier_id',(function ($query) {
                                $query->from('tiers')
                                    ->select('tiers.id')
                                    ->where('tiernumber','=',1);
                            }))->whereIn('races.season_id',(function ($query) use ($season) {
                                $query->from('seasons')
                                    ->select('seasons.id')
                                    ->where('seasonnumber','=', $season->seasonnumber);
                            }));
                    }))
                    ->where('dnf', '=', '0')
                    ->where('team_id', $team->id)
                    ->where('position', '<', '11')
                    ->get();

                foreach ($racedrivers as $racedriver)
                {
                    if ($racedriver->race->raceformat->format == "full")
                    {
                        $points += match (intval($racedriver->position))
                        {
                            1 => 25,
                            2 => 18,
                            3 => 15,
                            4 => 12,
                            5 => 10,
                            6 => 8,
                            7 => 6,
                            8 => 4,
                            9 => 2,
                            10 => 1,
                            default => 0,
                        };

                        if (Fastestlap::all()->where('driver_id', $racedriver->driver->id)->where('race_id', $racedriver->race->id)->count() > 0)
                        {
                            $points++;
                        }


                    } elseif ($racedriver->race->raceformat->format == "sprint") {

                        if (intval($racedriver->position) < 9) {

                            $points += 9 - intval($racedriver->position);

                        }
                    }
                }

                $team['points'] = $points;
                $teamSeason->add($team);

            }

            $teamSeason = $teamSeason->sortByDesc('points');
            $allSeasons->add($teamSeason);

        }

        return $allSeasons;

    }

    public function getAssociatedDrivers(Race $race)
    {
        return Racedriver::all()
            ->where('race_id', $race->id)
            ->sortBy('position');
    }

    public function index(): View
    {
        return view('public.tier1.index');
    }

    public function standings(): View
    {
        $allDriverSeasons = $this->calculateSeasonDriversPoints();
        $allTeamsSeason = $this->calculateTeamsPoints();

        return view('public.tier1.standings', compact('allDriverSeasons', 'allTeamsSeason'));
    }

    public function lineup(): View
    {
        $teams = Team::all();
        $drivers = Driver::all()->where('tier_id', 1);

        return view('public.tier1.lineup', compact('drivers', 'teams'),);
    }

    public function calendar(): View
    {
        $raceseasons = collect();

        $seasons = Season::all();

        foreach ($seasons as $season)
        {
            $races = Race::all()
                ->where('tier_id', 1)
                ->where('season_id', $season->id)
                ->sortBy('round');


            foreach ($races as $race)
            {
                if ($this->getAssociatedDrivers($race)->count() == 0)
                {
                    $race['done'] = false;
                }
                else
                {
                    $race['done'] = true;
                }
            }



            $raceseasons->put($season->seasonnumber, $races);

        }

        $racedrivers = Racedriver::all();
        $qualifyingdrivers = Qualifyingdriver::all();
        $fastestlaps = Fastestlap::all();

        return view('public.tier1.calendar', compact('raceseasons', 'racedrivers', 'qualifyingdrivers', 'fastestlaps'));
    }

    public function leaderboard(): View
    {
        $championshipdrivers = collect();
        $windrivers = collect();
        $podiumdrivers = collect();
        $poledrivers = collect();
        $fastestlapdrivers = collect();
        $racestartdrivers = collect();
        $pointsdrivers = collect();

        // WDC's

        Driverchampionship::query()
            ->select('*')
            ->whereIn('tier_id',(function ($query) {
                $query->from('tiers')
                    ->select('id')
                    ->where('tiers.tiernumber', '=', 1);
            }))
            ->get();

        foreach (Driver::all() as $driver)
        {
            $driver['amount'] = Driverchampionship::all()->where('tier_id', 1)->where('driver_id', $driver->id)->count();

            if (intval($driver->amount) > 0)
            {
                $championshipdrivers->add($driver);
            }
        }
        $championshipdrivers = $championshipdrivers->sortByDesc('amount');

        // Wins
        foreach (Driver::all() as $driver)
        {
            $racedrivers = Racedriver::query()
                ->select('*')
                ->where('position', '=', 1)
                ->where('driver_id', '=', $driver->id)
                ->whereIn('race_id',(function ($query) {
                    $query->from('races')
                        ->select('id')
                        ->whereIn('races.tier_id',(function ($query) {
                            $query->from('tiers')
                                ->select('id')
                                ->where('tiernumber','=',1);
                        }));
                }))
                ->whereIn('race_id',(function ($query) {
                    $query->from('races')
                        ->select('id')
                        ->whereIn('races.raceformat_id',(function ($query) {
                            $query->from('raceformats')
                                ->select('id')
                                ->where('format', '=', 'full');
                        }));
                }))
                ->get();

            $driver['amount'] = $racedrivers->count();

            if (intval($driver->amount) > 0)
            {
                $windrivers->add($driver);
            }
        }
        $windrivers = $windrivers->sortByDesc('amount');

        // Podiums
        foreach (Driver::all() as $driver)
        {
            $racedrivers = Racedriver::query()
                ->select('*')
                ->where('position', '<=', 3)
                ->where('driver_id', '=', intval($driver->id))
                ->whereIn('race_id',(function ($query) {
                    $query->from('races')
                        ->select('id')
                        ->whereIn('races.tier_id',(function ($query) {
                            $query->from('tiers')
                                ->select('id')
                                ->where('tiernumber', '=', 1);
                        }));
                }))
                ->whereIn('race_id',(function ($query) {
                    $query->from('races')
                        ->select('id')
                        ->whereIn('races.raceformat_id',(function ($query) {
                            $query->from('raceformats')
                                ->select('id')
                                ->where('format', '=', 'full');
                        }));
                }))
                ->get();

            $driver['amount'] = $racedrivers->count();

            if (intval($driver->amount) > 0)
            {
                $podiumdrivers->add($driver);
            }
        }

        $podiumdrivers = $podiumdrivers->sortByDesc('amount');

        // Poles
        foreach (Driver::all() as $driver)
        {
            $qualifyingdrivers = Qualifyingdriver::query()
                ->select('*')
                ->where('q3','=',1)
                ->where('driver_id','=', $driver->id)
                ->whereIn('race_id',(function ($query) {
                    $query->from('races')
                        ->select('id')
                        ->whereIn('races.tier_id',(function ($query) {
                            $query->from('tiers')
                                ->select('id')
                                ->where('tiernumber','=',1);
                        }));
                }))
                ->get();

            $shortqualifyingdrivers = Shortqualifyingdriver::query()
                ->select('*')
                ->where('position','=',1)
                ->where('driver_id','=', $driver->id)
                ->whereIn('race_id',(function ($query) {
                    $query->from('races')
                        ->select('id')
                        ->whereIn('races.tier_id',(function ($query) {
                            $query->from('tiers')
                                ->select('id')
                                ->where('tiernumber','=',1);
                        }));
                }))
                ->get();

            $driver['amount'] = $qualifyingdrivers->count() + $shortqualifyingdrivers->count();

            if (intval($driver->amount) > 0)
            {
                $poledrivers->add($driver);
            }
        }
        $poledrivers = $poledrivers->sortByDesc('amount');

        // Fastest laps
        foreach (Driver::all() as $driver)
        {
            $driver['amount'] = Fastestlap::query()
                ->select("*")
                ->where("driver_id", $driver->id)
                ->whereIn('race_id',(function ($query) {
                    $query->from('races')
                        ->select('id')
                        ->whereIn('races.tier_id',(function ($query) {
                            $query->from('tiers')
                                ->select('id')
                                ->where('tiernumber','=',1);
                        }));
                }))
                ->whereIn('race_id',(function ($query) {
                    $query->from('races')
                        ->select('id')
                        ->whereIn('races.raceformat_id',(function ($query) {
                            $query->from('raceformats')
                                ->select('id')
                                ->where('format', '=', 'full');
                        }));
                }))
                ->get()->count();

            if (intval($driver->amount) > 0)
            {
                $fastestlapdrivers->add($driver);
            }
        }
        $fastestlapdrivers = $fastestlapdrivers->sortByDesc('amount');

        // Race starts
        foreach (Driver::all() as $driver)
        {
            $driver['amount'] = Racedriver::query()
                ->select("*")
                ->where("driver_id", $driver->id)
                ->whereIn('race_id',(function ($query) {
                    $query->from('races')
                        ->select('id')
                        ->whereIn('races.tier_id',(function ($query) {
                            $query->from('tiers')
                                ->select('id')
                                ->where('tiernumber','=',1);
                        }));
                }))
                ->whereIn('race_id',(function ($query) {
                    $query->from('races')
                        ->select('id')
                        ->whereIn('races.raceformat_id',(function ($query) {
                            $query->from('raceformats')
                                ->select('id')
                                ->where('format', '=', 'full');
                        }));
                }))
                ->get()->count();

            if (intval($driver->amount) > 0)
            {
                $racestartdrivers->add($driver);
            }
        }
        $racestartdrivers = $racestartdrivers->sortByDesc('amount');

        foreach (Driver::all() as $driver)
        {
            $driver['points'] = $this->calculateTotalDriverPoints($driver);

            if (intval($driver->points) > 0)
            {
                $pointsdrivers->add($driver);
            }
        }
        $pointsdrivers = $pointsdrivers->sortByDesc('points');

        return view('public.tier1.leaderboard', compact('championshipdrivers', 'windrivers', 'podiumdrivers', 'poledrivers', 'fastestlapdrivers', 'racestartdrivers', 'pointsdrivers'));

    }
}
