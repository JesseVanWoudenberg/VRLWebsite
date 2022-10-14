@extends('layouts.private-layout')

@section('page-title') Driver Championship - Delete @endsection

@section('page') driverchampionship-create-edit-delete @endsection

@section('content')

    <div>
        @if ($errors->any())
            <div>
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('driverchampionship.destroy', ['driverchampionship' => $driverchampionship->id]) }}" method="POST">

                @method('DELETE')
                @csrf

                <label for="driver_id">Team</label>
                <div class="select-container">
                    <select name="driver_id" id="driver_id">
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" @if($driverchampionship->driver_id == $driver->id) selected @endif disabled>{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="season_id">Season</label>
                <div class="select-container">
                    <select name="season_id" id="season_id">
                        @foreach($seasons as $season)
                            <option value="{{ $season->id }}" @if($driverchampionship->season_id == $season->id) selected @endif disabled>{{ $season->seasonnumber }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="team_id">Team</label>
                <div class="select-container">
                    <select name="team_id" id="team_id">
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" @if($driverchampionship->team_id == $team->id) selected @endif disabled>{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="tier_id">Tier Number</label>
                <div class="select-container">
                    <select name="tier_id" id="tier_id">
                        @foreach($tiers as $tier)
                            <option value="{{ $tier->id }}" @if($driverchampionship->tier_id == $tier->id) selected @endif disabled>{{ $tier->tiernumber }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="submit" value="Delete">
            </form>
        </div>
    </div>

@endsection
