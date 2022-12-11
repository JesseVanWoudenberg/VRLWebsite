@php use App\Models\Constructorchampionship;use App\Models\Driverchampionship;use App\Models\Fastestlap;use App\Models\Qualifyingdriver;use App\Models\Racedriver;use App\Models\Shortqualifyingdriver; @endphp
@extends('layouts.public-layout')

@section('page-title')
    Team - {{ $team->name }}
@endsection

@section('page')
    open-team-show
@endsection

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
                <td>{{ Racedriver::all()->where('team_id', $team->id)->where('dnf', 0)->where('position', 1)->count() }}</td>
            </tr>

            <tr>
                <th>Fastest laps</th>
                <td>{{ Fastestlap::all()->where('team_id', $team->id)->count() }}</td>
            </tr>

            <tr>
                <th>Poles</th>
                <td>{{ Qualifyingdriver::all()->where('team_id', $team->id)->where('q3', 1)->count() + Shortqualifyingdriver::all()->where('team_id', $team->id)->where('position', 1)->count() }}</td>
            </tr>

            <tr>
                <th>Points</th>
                <td>{{ $totalpoints }}</td>
            </tr>

            <tr>
                <th>WDC's</th>
                <td>{{ Driverchampionship::all()->where('team_id', $team->id)->count() }}</td>
            </tr>

            <tr>
                <th>WCC's</th>
                <td>{{ Constructorchampionship::all()->where('team_id', $team->id)->count() }}</td>
            </tr>

            </tbody>
        </table>
    </div>

@endsection
