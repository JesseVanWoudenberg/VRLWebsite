@extends('layouts.private-layout')

@section('page-title') Constructor Championship - Edit @endsection

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
            <form action="{{ route('constructorchampionship.update', ['constructorchampionship' => $constructorchampionship->id]) }}" method="POST">

                @method('PUT')
                @csrf

                <label for="season_id">Season</label>
                <div class="select-container">
                    <select name="season_id" id="season_id">
                        @foreach($seasons as $season)
                            <option value="{{ $season->id }}" @if($season->id == $constructorchampionship->season->id) selected @endif>Season: {{ $season->seasonnumber }} - Tier: {{ $season->tier->tiernumber }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="team_id">Team</label>
                <div class="select-container">
                    <select name="team_id" id="team_id">
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" @if($team->id == $constructorchampionship->team->id) selected @endif>{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="submit" value="Edit">
            </form>
        </div>
    </div>

@endsection
