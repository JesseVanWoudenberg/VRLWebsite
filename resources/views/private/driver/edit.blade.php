@extends('layouts.private-layout')

@section('page-title') Driver - Edit @endsection

@section('page') driver-create-edit-delete @endsection

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
            <form action="{{ route('driver.update', ['driver' => $driver->id]) }}" method="POST">

                @method('PUT')
                @csrf

                <label for="name">Name</label>
                <input @error('name') @enderror type="text" id="name" name='name' value="{{ $driver->name }}">

                <label for="nationality">Nationality</label>
                <input @error('name') @enderror type="text" id="nationality" name='nationality' value="{{ $driver->nationality }}">

                <label for="drivernumber">Driver Number</label>
                <input @error('name') @enderror type="number" id="drivernumber" name='drivernumber' value="{{ $driver->drivernumber }}">

                <label for="team_id">Team</label>
                <div class="select-container">
                    <select name="team_id" id="team_id">
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" @if($team->id == $driver->team->id) selected @endif >{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="tier_id">Tier Number</label>
                <div class="select-container">
                    <select name="tier_id" id="tier_id">
                        @foreach($tiers as $tier)
                            <option value="{{ $tier->id }}" @if($tier->id == $driver->tier->id) selected @endif >{{ $tier->tiernumber }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="submit" value="Edit">
            </form>
        </div>
    </div>

@endsection
