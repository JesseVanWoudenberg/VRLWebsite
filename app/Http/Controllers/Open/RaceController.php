<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use App\Models\Fastestlap;
use App\Models\Qualifyingdriver;
use App\Models\Race;
use App\Models\Racedriver;
use App\Models\Shortqualifyingdriver;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class RaceController extends Controller
{
    public function convertFloatToTime($laptime): string
    {
        if (!($laptime > 0))
        {
            return "N/A";
        }

        $formattedLaptime = "";

        if ($laptime < 60)
        {
            $formattedLaptime .= "0:";
        }
        else
        {
            $formattedLaptime .=  bcdiv(bcsub($laptime, bcmod(strval($laptime), "60")), "60") . ":";
        }

        if (floor(bcmod(strval($laptime), "60")) < 10)
        {
            $formattedLaptime .= "0" . floor( bcmod(strval($laptime), "60")) . ":";
        }
        else
        {
            $formattedLaptime .= floor(bcmod(strval($laptime), "60")) . ":";
        }

        // Adding extra 0's
        if (bcmod(bcdiv(bcsub($laptime, bcmod(strval($laptime), "60")), "60"), 0.1))
        {
            $formattedLaptime .= "00";
        }
        else if (bcmod(bcdiv(bcsub($laptime, bcmod(strval($laptime), "60")), "60"), 0.01))
        {
            $formattedLaptime .= "0";
        }

        $formattedLaptime .= ltrim(bcsub(bcmod(strval($laptime), "60", 3), floor(bcmod(strval($laptime), "60")), 3), "0.");

        return $formattedLaptime;
    }

    public function getAssociatedDrivers(Race $race)
    {
        return Racedriver::all()
            ->where('race_id', $race->id)
            ->sortBy('position');
    }

    public function getAssociatedFastestLap(Race $race)
    {
        $fastestlap = Fastestlap::all()
            ->where('race_id', $race->id)
            ->first();

        if ($fastestlap != null)
        {
            $fastestlap->laptime = $this->convertFloatToTime($fastestlap->laptime);
        }

        return $fastestlap;
    }
    
    public function getAssociatedFullQualifyingDrivers(Race $race): Collection
    {
        $fullqualifyingdrivers = Qualifyingdriver::all()
            ->where('race_id', $race->id)
            ->sortBy('q3');

        foreach ($fullqualifyingdrivers as $fullqualifyingdriver)
        {
            $fullqualifyingdriver->q1laptime = $this->convertFloatToTime($fullqualifyingdriver->q1laptime);
            $fullqualifyingdriver->q2laptime = $this->convertFloatToTime($fullqualifyingdriver->q2laptime);
            $fullqualifyingdriver->q3laptime = $this->convertFloatToTime($fullqualifyingdriver->q3laptime);
        }

        return $fullqualifyingdrivers;
    }

    public function getAssociatedShortQualifyingDrivers(Race $race): Collection
    {
        $shortqualifyingdrivers = Shortqualifyingdriver::all()
            ->where('race_id', $race->id)
            ->sortBy('position');

        foreach ($shortqualifyingdrivers as $shortqualifyingdriver)
        {
            $shortqualifyingdriver->laptime = $this->convertFloatToTime($shortqualifyingdriver->laptime);
        }

        return $shortqualifyingdrivers;
    }

    public function show(Race $race): View
    {
        $racedrivers = $this->getAssociatedDrivers($race);
        $fastestlap = $this->getAssociatedFastestLap($race);

        if ($this->getAssociatedFullQualifyingDrivers($race)->count() > 0)
        {
            $fullqualifyingdrivers = $this->getAssociatedFullQualifyingDrivers($race);

            return view('public.race-show', compact('race', 'racedrivers', 'fastestlap', 'fullqualifyingdrivers'));
        }
        elseif($this->getAssociatedShortQualifyingDrivers($race)->count() > 0)
        {
            $shortqualifyingdrivers = $this->getAssociatedShortQualifyingDrivers($race);

            return view('public.race-show', compact('race', 'racedrivers', 'fastestlap', 'shortqualifyingdrivers'));
        }
        else
        {
            return view('public.race-show', compact('race', 'racedrivers', 'fastestlap'));
        }
    }
}
