@php use App\Models\Availability\AvailabilityType; @endphp
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
                        <th class="number">Driver</th>
                        <th class="number">Availability Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($driverAvailabilities as $driverAvailability)
                        <tr>
                            <td class="center">{{ $driverAvailability->driver->name }}</td>
                            <td class="center {{ strtolower(AvailabilityType::all()->where('id', '=', $driverAvailability->availability_type_id)->first()->name) }}">{{ AvailabilityType::all()->where('id', '=', $driverAvailability->availability_type_id)->first()->name }}</td>
                        </tr>
                    @endforeach

                    @foreach($leftoverDrivers as $leftoverDriver)
                        <tr>
                            <td class="center">{{ $leftoverDriver->name }}</td>
                            <td class="center">No availability</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
