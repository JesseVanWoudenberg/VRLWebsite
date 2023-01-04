@php use App\Models\Availability\AvailabilityType; use App\Models\Availability\DriverAvailability;use Illuminate\Support\Facades\Auth; use Carbon\Carbon; @endphp
@extends('layouts.driver-layout')

@section('page-title')
    Driver - Availability
@endsection

@section('page')
    driver-availability-index
@endsection

@section('content')

    <div class="availability-list-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Availability - Season: {{ $currentSeason }} - Tier: {{ $driverTier }}</h1>
            @endif
        </div>

        <div class="availability-races-container">

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th class="number">Round</th>
                            <th>Track</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($raceAvailabilities as $raceAvailability)
                            <tr>
                                <td class="number">{{ $raceAvailability->race->round }}</td>
                                <td>{{ $raceAvailability->race->track->name }}</td>
                                <td>{{ Carbon::parse($raceAvailability->race->date)->format('F jS Y') }}</td>
                                <td>
                                    @if(DriverAvailability::all()
                                                     ->where('race_availability_id', '=', $raceAvailability->id)
                                                     ->where('driver_id', '=', Auth::user()->driver->id)
                                                     ->count() > 0)

                                        {{
                                             AvailabilityType::all()->where('id', '=', DriverAvailability::all()
                                                 ->where('race_availability_id', '=', $raceAvailability->id)
                                                 ->where('driver_id', '=', Auth::user()->driver->id)
                                                 ->first()->availability_type_id)->first()->name
                                        }}

                                    @else
                                        Not filled in
                                    @endif
                                </td>

                                <td class="availability-button"><a href="{{ route('driverpanel.availability.edit', ['id' => $raceAvailability->id]) }}">Do Availability</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
