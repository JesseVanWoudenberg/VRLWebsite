@extends('layouts.private-layout')

@section('page-title') Constructor Championship - Show @endsection

@section('page') constructorchampionship-show @endsection

@section('content')

    <div class="show-container">
        <table>
            <tr>
                <th>Team</th>
                <td><a href="{{ route('team.show', ['team' => $constructorchampionship->team->id]) }}">{{ $constructorchampionship->team->name }}</a></td>
            </tr>

            <tr>
                <th>Season</th>
                <td><a href="{{ route('season.show', ['season' => $constructorchampionship->season->id]) }}">{{ $constructorchampionship->season->seasonnumber }}</a></td>
            </tr>

            <tr>
                <th>Tier</th>
                <td>{{ $constructorchampionship->tier->tiernumber }}</td>
            </tr>
        </table>
    </div>

@endsection
