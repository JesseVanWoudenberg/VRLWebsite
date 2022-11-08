@extends('layouts.private-layout')

@section('page-title') Constructor Championship - Create @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Create WCC</h1>
            @endif
        </div>

        <form action="{{ route('constructorchampionship.store') }}" method="POST">

            @csrf

            <label for="season_id">Season</label>
            <div class="select-container">
                <select name="season_id" id="season_id">
                    <option value="" disabled selected>Select a season</option>
                    @foreach($seasons as $season)
                        <option value="{{ $season->id }}">Season: {{ $season->seasonnumber }} - Tier: {{ $season->tier->tiernumber }}</option>
                    @endforeach
                </select>
            </div>

            <label for="team_id">Team</label>
            <div class="select-container">
                <select name="team_id" id="team_id">
                    <option value="" disabled selected>Select a team</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Add">
        </form>
    </div>

@endsection
