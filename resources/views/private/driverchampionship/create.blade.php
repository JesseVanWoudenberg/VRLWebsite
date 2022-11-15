@extends('layouts.private-layout')

@section('page-title') Driver Championship - Create @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Create Driver Championship</h1>
            @endif
        </div>

        <form action="{{ route('driverchampionship.store') }}" method="POST">

            @csrf

            <label for="driver_id">Driver</label>
            <div class="select-container">
                <select name="driver_id" id="driver_id">
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>

            <label for="season_id">Season</label>
            <div class="select-container">
                <select name="season_id" id="season_id">
                    @foreach($seasons as $season)
                        <option value="{{ $season->id }}">{{ $season->seasonnumber }}</option>
                    @endforeach
                </select>
            </div>

            <label for="team_id">Team</label>
            <div class="select-container">
                <select name="team_id" id="team_id">
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <label for="tier_id">Tier Number</label>
            <div class="select-container">
                <select name="tier_id" id="tier_id">
                    @foreach($tiers as $tier)
                        <option value="{{ $tier->id }}">{{ $tier->tiernumber }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Add">
        </form>
    </div>


@endsection
