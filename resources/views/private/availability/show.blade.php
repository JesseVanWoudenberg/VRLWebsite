@php use App\Models\Availability\AvailabilityType;use App\Models\Availability\DriverAvailability; @endphp
@extends('layouts.private-layout')

@section('page-title')
    Availability - Show
@endsection

@section('page')
    availability-show
@endsection

@section('content')

    <div class="availability-container">

        <div class="table-header">

            @if(Session::exists('status'))
                <h1 @if(Illuminate\Support\Str::contains(Session::get('status'), 'create')) class="created" @endif
                @if(Illuminate\Support\Str::contains(Session::get('status'), 'delete')) class="deleted" @endif
                    @if(Illuminate\Support\Str::contains(Session::get('status'), 'updated')) class="edited" @endif>
                    {{ Session::get('status') }}
                </h1>
            @elseif($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Manage Availability</h1>
            @endif
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>Track</th>
                    <th class="number">Round</th>
                    <th class="number">Season</th>
                    <th class="number">Tier</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>{{ $raceAvailability->race->track->name }}</td>
                    <td class="number">{{ $raceAvailability->race->round }}</td>
                    <td class="number">{{ $raceAvailability->race->season->seasonnumber }}</td>
                    <td class="number">{{ $raceAvailability->race->tier->tiernumber }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th class="number">Accepted</th>
                    <th class="number">Declined</th>
                    <th class="number">Tentative</th>
                    <th class="number">No Response</th>
                </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="number">
                            {{ $acceptedCount = DriverAvailability::query()->select('*')->where('race_availability_id', '=', $raceAvailability->id)->whereIn('driver_availabilities.availability_type_id', function ($query) { $query->select('availability_types.id')->from('availability_types')->where('availability_types.name', '=', 'Accepted'); })->count() }}
                        </td>

                        <td class="number">
                            {{ $acceptedCount = DriverAvailability::query()->select('*')->where('race_availability_id', '=', $raceAvailability->id)->whereIn('driver_availabilities.availability_type_id', function ($query) { $query->select('availability_types.id')->from('availability_types')->where('availability_types.name', '=', 'Declined'); })->count() }}
                        </td>

                        <td class="number">
                            {{ $acceptedCount = DriverAvailability::query()->select('*')->where('race_availability_id', '=', $raceAvailability->id)->whereIn('driver_availabilities.availability_type_id', function ($query) { $query->select('availability_types.id')->from('availability_types')->where('availability_types.name', '=', 'Tentative'); })->count() }}
                        </td>

                        <td class="number">
                            {{ $acceptedCount = DriverAvailability::query()->select('*')->where('race_availability_id', '=', $raceAvailability->id)->whereIn('driver_availabilities.availability_type_id', function ($query) { $query->select('availability_types.id')->from('availability_types')->where('availability_types.name', '=', 'No Response'); })->count() }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th class="number">Driver</th>
                    <th class="number">Availability Status</th>
                </tr>
                </thead>

                <tbody>
                @foreach($driverAvailabilities as $driverAvailability)
                    <tr>
                        <td class="center">{{ $driverAvailability->driver->name }}</td>
                        <td class="center {{ str_replace(' ', '-', strtolower(AvailabilityType::all()->where('id', '=', $driverAvailability->availability_type_id)->first()->name)) }}">{{ AvailabilityType::all()->where('id', '=', $driverAvailability->availability_type_id)->first()->name }}</td>

                        <td class="availability-button">
                            <a href="{{ route('admin.availability.edit', ['raceAvailabilityId' => $raceAvailability->id, 'driverId' => $driverAvailability->driver_id]) }}">Edit Availability</a>
                        </td>
                    </tr>
                @endforeach

                @foreach($leftoverDrivers as $leftoverDriver)
                    <tr>
                        <td class="center">{{ $leftoverDriver->name }}</td>
                        <td class="center">No availability</td>

                        <td class="availability-button">
                            <a href="{{ route('admin.availability.edit', ['raceAvailabilityId' => $raceAvailability->id, 'driverId' => $leftoverDriver->id]) }}">Edit Availability</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
