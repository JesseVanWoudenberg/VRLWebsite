@extends('layouts.private-layout')

@section('page-title') Driver Championship - Show @endsection

@section('page') private-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show Driver Championship</h1>

        </div>

        <div class="show-content">

            <h1>Team</h1>
            <p><a href="{{ route('team.show', ['team' => $driverchampionship->team->id]) }}">{{ $driverchampionship->team->name }}</a></p>

            <h1>Driver</h1>
            <p><a href="{{ route('driver.show', ['driver' => $driverchampionship->driver->id]) }}">{{ $driverchampionship->driver->name }}</a></p>

            <h1>Season</h1>
            <p><a href="{{ route('season.show', ['season' => $driverchampionship->season->id]) }}">{{ $driverchampionship->season->seasonnumber }}</a></p>

            <h1>Tier</h1>
            <p>{{ $driverchampionship->tier->tiernumber }}</p>
        </div>
    </div>

@endsection
