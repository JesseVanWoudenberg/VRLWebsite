@extends('layouts.private-layout')

@section('page-title') Driver Championship - Show @endsection

@section('page') driverchampionship-show @endsection

@section('content')

    <div class="show-container">
        <table>
            <tr>
                <th>Team</th>
                <td><a href="{{ route('team.show', ['team' => $driverchampionship->team->id]) }}">{{ $driverchampionship->team->name }}</a></td>
            </tr>

            <tr>
                <th>Driver</th>
                <td><a href="{{ route('driver.show', ['driver' => $driverchampionship->driver->id]) }}">{{ $driverchampionship->driver->name }}</a></td>
            </tr>

            <tr>
                <th>Season</th>
                <td><a href="{{ route('season.show', ['season' => $driverchampionship->season->id]) }}">{{ $driverchampionship->season->seasonnumber }}</a></td>
            </tr>

            <tr>
                <th>Tier</th>
                <td>{{ $driverchampionship->tier->tiernumber }}</td>
            </tr>
        </table>
    </div>

@endsection
