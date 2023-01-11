<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use App\Models\Fastestlap;
use App\Models\Qualifyingdriver;
use App\Models\Racedriver;
use App\Models\Shortqualifyingdriver;
use Illuminate\View\View;
use App\Models\Driver;

class DriverController extends Controller
{
    public function show(Driver $driver): View
    {
        $totalpoints = 0;

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

                $totalpoints += match (intval($racedriver->position)) {
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

                if (Fastestlap::all()->where('driver_id', $driver->id)->where('race_id', $racedriver->race->id)->count() > 0) {
                    $totalpoints++;
                }

            } elseif ($racedriver->race->raceformat->format == "sprint") {

                if (intval($racedriver->position) < 9) {

                    $totalpoints += 9 - intval($racedriver->position);

                }
            }
        }

        $positions = collect();

        if (Qualifyingdriver::all()->where('driver_id', $driver->id)->where('q3', '!=', 100)->count() > 0)
        {
            $positions->add(Qualifyingdriver::all()->where('driver_id', $driver->id)->min('q3'));
        }
        if (Shortqualifyingdriver::all()->where('driver_id', $driver->id)->where('position', '!=', 100)->count() > 0)
        {
            $positions->add(Shortqualifyingdriver::all()->where('driver_id', $driver->id)->min('position'));
        }

        $highestPosition = $positions->max();

        $highestPositionAmount = Qualifyingdriver::all()->where('driver_id', $driver->id)->where('q3', $highestPosition)->count() + Shortqualifyingdriver::all()->where('driver_id', $driver->id)->where('position', $highestPosition)->count();

        $wins = Racedriver::query()
            ->select('*')
            ->where('position', '=', 1)
            ->where('driver_id', '=', $driver->id)
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
                            ->where('format', '=', 'full')
                            ->orWhere('format', '=', 'preseason');
                    }));
            }))
            ->get()->count();

        return view('public.driver-show', compact('driver', 'totalpoints', 'highestPosition', 'highestPositionAmount', 'wins'));
    }
}
