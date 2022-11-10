@extends('layouts.private-layout')

@section('page-title') Constructor Championship - Show @endsection

@section('page') private-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show Constructor Championship</h1>

        </div>

        <div class="show-content">

            <h1>Team</h1>
            <p><a href="{{ route('team.show', ['team' => $constructorchampionship->team->id]) }}">{{ $constructorchampionship->team->name }}</a></p>

            <h1>Season</h1>
            <p><a href="{{ route('season.show', ['season' => $constructorchampionship->season->id]) }}">{{ $constructorchampionship->season->seasonnumber }}</a></p>

            <h1>Tier</h1>
            <p>{{ $constructorchampionship->tier->tiernumber }}</p>

        </div>
    </div>

@endsection
