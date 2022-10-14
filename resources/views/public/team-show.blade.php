@extends('layouts.public-layout')

@section('page-title') Team - {{ $team->name }} @endsection

@section('page') open-team-show @endsection

@section('content')

    {{--
        <> Basic info { Name, Nationality, Driver number, Team, Tier  }
        <> Wins/Highest finishing position
        <> Podiums
        <> Total points
        <> Poles/Highest grid position
        <> Average finishing position
        <> Average grid position
        <> Race starts
        <> WDC/(WCC's)
        First race/last race?


       --}}

    <div class="team-info-container">

        <h1 class="{{ strtolower(str_replace(' ', '', $team->name)) }}">{{ $team->name }}</h1>

        <table>

            <tbody>

            <tr>
                <th>Power unit</th>
                <td>{{ $team->powerunit->name }}</td>
            </tr>

            <tr>
                <th>Wins</th>
                <td>{{ \App\Models\Racedriver::all()->where('team_id', $team->id)->where('dnf', 0)->where('position', 1)->count() }}</td>
            </tr>

            <tr>
                <th>Fastest laps</th>
                <td>{{ \App\Models\Fastestlap::all()->where('team_id', $team->id)->count() }}</td>
            </tr>

            <tr>
                <th>Poles</th>
                <td>{{ \App\Models\Qualifyingdriver::all()->where('q3', 1)->where('team_id', $team->id)->count() }}</td>
            </tr>

            <tr>
                <th>Points</th>
                <td>{{ $totalpoints }}</td>
            </tr>

            <tr>
                <th>WDC's</th>
                <td>{{ \App\Models\Driverchampionship::all()->where('team_id', $team->id)->count() }}</td>
            </tr>

            <tr>
                <th>WCC's</th>
                <td>{{ \App\Models\Constructorchampionship::all()->where('team_id', $team->id)->count() }}</td>
            </tr>

            </tbody>
        </table>
    </div>

@endsection
