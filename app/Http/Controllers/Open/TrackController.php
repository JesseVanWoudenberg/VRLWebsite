<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use App\Models\Fastestlap;
use App\Models\Qualifyingdriver;
use App\Models\Race;
use App\Models\Shortqualifyingdriver;
use App\Models\Track;
use Carbon\Carbon;
use Illuminate\View\View;

class TrackController extends Controller
{
    public function convertFloatToTime($laptime): string
    {
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

        $formattedLaptime .= ltrim(bcsub(bcmod(strval($laptime), "60", 3), floor(bcmod(strval($laptime), "60")), 3), "0.");

        return $formattedLaptime;
    }

    public function show(Track $track): View
    {
        $times = collect();

        // Q1
        $fullQualifyingLaps = Qualifyingdriver::all();
        foreach ($fullQualifyingLaps as $lap)
        {
            if ($lap->race->track->id != $track->id)
            {
                $fullQualifyingLaps->pull($fullQualifyingLaps->search($lap));
            }
        }
        $fastestQualifyingQ1 = $fullQualifyingLaps->where('q1laptime', '>', '0')->sortBy("q1laptime")->first();
        if ($fastestQualifyingQ1 != null)
        {
            $fastestQualifyingQ1['laptime'] = $fastestQualifyingQ1->q1laptime;
            $times->add($fastestQualifyingQ1);
        }

        // Q2
        $fastestQualifyingQ2 = $fullQualifyingLaps->where('q2laptime', '>', '0')->sortBy("q2laptime")->first();
        if ($fastestQualifyingQ2 != null)
        {
            $fastestQualifyingQ2['laptime'] = $fastestQualifyingQ2->q2laptime;
            $times->add($fastestQualifyingQ2);
        }

        // Q3
        $fastestQualifyingQ3 = $fullQualifyingLaps->where('q3laptime', '>', '0')->sortBy("q3laptime")->first();
        if ($fastestQualifyingQ3 != null)
        {
            $fastestQualifyingQ3['laptime'] = $fastestQualifyingQ3->q3laptime;
            $times->add($fastestQualifyingQ3);
        }

        // Short Q
        $shortQualifyingLaps = Shortqualifyingdriver::all();
        foreach ($shortQualifyingLaps as $lap)
        {
            if ($lap->race->track->id != $track->id)
            {
                $shortQualifyingLaps->pull($shortQualifyingLaps->search($lap));
            }
        }
        $fastestShortQualifying = $shortQualifyingLaps->where('laptime', '>', '0')->sortBy("laptime")->first();
        if ($fastestShortQualifying != null)
        {
            $times->add($fastestShortQualifying);
        }

        // Fastest Laps
        $fastestLaps = Fastestlap::all();
        foreach ($fastestLaps as $lap)
        {
            if ($lap->race->track->id != $track->id)
            {
                $fastestLaps->pull($fastestLaps->search($lap));
            }
        }
        $fastestFastestLap = $fastestLaps->sortBy("laptime")->first();
        if ($fastestFastestLap != null)
        {
            $times->add($fastestFastestLap);
        }

        $fastestLap = $times->sortBy("laptime")->first();

        if ($fastestLap != null)
        {
            $fastestLap->laptime = $this->convertFloatToTime($fastestLap->laptime);
        }

        $races = Race::all();

        foreach ($races as $race)
        {
            if ($race->track->id != $track->id)
            {
                $races->pull($races->search($race));
            }

            $race->date = Carbon::make($race->date)->timestamp;
        }

        $races->sortBy('date');

        $firstgrandprix = $races->sortBy('date')->first();

        return view('public.track', compact('track', 'fastestLap', 'firstgrandprix'));

    }
}
