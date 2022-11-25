@extends('layouts.private-layout')

@section('page-title') Penalty point - Create @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Add Penalty points</h1>
            @endif
        </div>

        <form action="{{ route('penaltypoint.store') }}" method="GET">

            @csrf

            <label for="driver_id">Driver</label>
            <div class="select-container">
                <select name="driver_id" id="driver_id">
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>

            <label for="race_id">Race</label>
            <div class="select-container">
                <select name="race_id" id="race_id">
                    @foreach($races as $race)
                        <option value="{{ $race->id }}">Season {{ $race->season->seasonnumber }} | Tier {{ $race->tier->tiernumber }} | Round {{ $race->round }}: {{ $race->track->name }}</option>
                    @endforeach
                </select>
            </div>

            <label for="amount">Amount</label>
            <input @error('name') @enderror type="number" step="1" id="amount" name='amount' value="{{ old('amount') }}">

            <input type="submit" value="Add">
        </form>
    </div>

@endsection
