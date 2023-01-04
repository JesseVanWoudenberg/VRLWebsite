<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Availability\AvailabilityType;
use App\Models\Availability\DriverAvailability;
use App\Models\Availability\RaceAvailability;
use App\Models\Log;
use App\Models\Season;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AvailabilityController extends Controller
{
    public function index(): View
    {
        $raceAvailabilities = RaceAvailability::query()
            ->select("race_availabilities.*", "races.round")
            ->join('races', 'races.id', '=' , 'race_availabilities.race_id')
            ->where('races.season_id', '=',
                Season::all()
                    ->where('tier_id', '=', Auth::user()->driver->tier->id)
                    ->sortByDesc('seasonnumber')
                    ->first()->id)
            ->orderBy('races.round')
            ->get();

        $currentSeason = Season::all()->where('tier_id', '=', Auth::user()->driver->tier_id)->max('seasonnumber');
        $driverTier = Auth::user()->driver->tier->tiernumber;

        return view('driver.availability.index', compact('raceAvailabilities', 'currentSeason', 'driverTier'));
    }

    public function edit(int $raceAvailabilityId): View
    {
        $raceAvailability = RaceAvailability::all()->where('id', '=', $raceAvailabilityId)->first();

        return view('driver.availability.edit', compact('raceAvailability'));
    }

    public function update(Request $request, int $raceAvailabilityId): RedirectResponse
    {
        $raceAvailability = RaceAvailability::all()->where('id', '=', $raceAvailabilityId)->first();

        foreach (DriverAvailability::all()
            ->where('race_availability_id', '=', $raceAvailability->id)
            ->where('driver_id', '=', Auth::user()->driver->id) as $existingDriverAvailability) {

            $existingDriverAvailability->delete();

        }

        $driverAvailability = new DriverAvailability();

        $driverAvailability->race_availability_id = $raceAvailability->id;
        $driverAvailability->driver_id = Auth::user()->driver->id;
        $driverAvailability->availability_type_id = AvailabilityType::all()->where('name', '=', $request->input('availability-type'))->first()->id;

        $driverAvailability->save();

        return redirect()->route('driverpanel.availability')->with('Availability Successfully Updated');
    }

    public function CheckAvailability()
    {
        $log = new Log();
        $log->user_id = 1;
        $log->action = "Schedule Ran";
        $log->save();
    }
}
