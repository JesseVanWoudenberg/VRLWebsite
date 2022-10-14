<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use App\Models\Fastestlap;
use App\Models\Racedriver;
use Illuminate\View\View;
use App\Models\Team;

class TeamController extends Controller
{
    public function show(Team $team): View
    {
        $totalpoints = 0;

        $racedrivers = Racedriver::all()->where('team_id', $team->id);

        foreach ($racedrivers as $racedriver)
        {
            if ($racedriver->dnf == 1)
            {
                continue;
            }

            if ($racedriver->race->raceformat->format == "full")
            {
                $totalpoints += match ($racedriver->position)
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
                };

                if ($racedriver->position < 11)
                {
                    if (Fastestlap::all()->where('driver_id', $racedriver->driver->id)->where('team_id', $team->id)->where('race_id', $racedriver->race->id)->count() > 0)
                    {
                        $totalpoints++;
                    }
                }

            } elseif ($racedriver->race->raceformat->format == "sprint") {

                if ($racedriver->position < 9) {

                    $totalpoints += 9 - $racedriver->position;

                    if (Fastestlap::all()->where('team_id', $team->id)->where('race_id', $racedriver->race->id)->count() > 0)
                    {
                        $totalpoints++;
                    }
                }
            }
        }

        return view('public.team-show', compact('team', 'totalpoints', 'racedrivers'));
    }
}
