<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Availability\AvailabilityType;
use App\Models\Availability\DriverAvailability;
use App\Models\Availability\RaceAvailability;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AvailabilityController extends Controller
{
    public function index(): View
    {
        User::checkPermissions("availability index");

        $raceAvailabilities = RaceAvailability::all();

        return view('private.availability.index', compact('raceAvailabilities'));
    }

    public function show(int $raceAvailabilityId): View
    {
        User::checkPermissions("availability show");

        $raceAvailability = RaceAvailability::all()->where('id', '=', $raceAvailabilityId)->first();

        $driverAvailabilities = DriverAvailability::all()->where('race_availability_id', '=', $raceAvailability->id);

        $leftoverDrivers = Driver::query()
            ->select('*')
            ->whereIn('tier_id', function ($query) {
                $query->select('tiers.id')
                    ->from('tiers')
                    ->where('tiers.tiernumber', '=', 1);
            })
            ->whereNotIn('id', function($query) use ($raceAvailabilityId) {
                $query->select('driver_availabilities.driver_id')
                    ->from('driver_availabilities')
                    ->where('race_availability_id', '=', $raceAvailabilityId);
            })
            ->whereNotIn('team_id', function($query) {
                $query->select('teams.id')
                    ->from('teams')
                    ->where('name', '=', 'Reserves')
                    ->orWhere('name', '=', 'None');
            })->get();

        return view('private.availability.show', compact('raceAvailability', 'driverAvailabilities', 'leftoverDrivers'));
    }
}
