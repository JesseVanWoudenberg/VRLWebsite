@extends('layouts.private-layout')

@section('page-title') Driver - Delete @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Delete Driver</h1>
            @endif
        </div>

        <form action="{{ route('driver.destroy', ['driver' => $driver->id]) }}" method="POST">

            @method('DELETE')
            @csrf

            <label for="name">Name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ $driver->name }}" disabled>

            <label for="nationality">Nationality</label>
            <input @error('name') @enderror type="text" id="nationality" name='nationality' value="{{ $driver->nationality }}" disabled>

            <label for="drivernumber">Driver Number</label>
            <input @error('name') @enderror type="number" id="drivernumber" name='drivernumber' value="{{ $driver->drivernumber }}" disabled>

            <label for="team_id">Team</label>
            <div class="select-container">
                <select name="team_id" id="team_id">
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" @if($team->id == $driver->team->id) selected @endif disabled>{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <label for="tier_id">Tier Number</label>
            <div class="select-container">
                <select name="tier_id" id="tier_id">
                    @foreach($tiers as $tier)
                        <option value="{{ $tier->id }}" @if($tier->id == $driver->tier->id) selected @endif disabled>{{ $tier->tiernumber }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Remove">
        </form>
    </div>

@endsection
