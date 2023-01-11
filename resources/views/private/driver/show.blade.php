@extends('layouts.private-layout')

@section('page-title') Driver - Show @endsection

@section('page') private-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show Driver</h1>

        </div>

        <div class="show-content">

            <h1>Name</h1>
            <p>{{ $driver->name }}</p>

            <h1>Nationality</h1>
            <p>{{ $driver->nationality }}</p>

            <h1>Driver number</h1>
            <p>{{ $driver->drivernumber }}</p>

            <h1>Team</h1>
            <p><a href="{{ route('team.show', ['team' => $driver->team->id]) }}">{{ $driver->team->name }}</a></p>

            <h1>Tier</h1>
            <p>{{ $driver->tier->tiernumber }}</p>

        </div>
    </div>

    <div class="show-container">

        <div class="table-header">

            <h1>Driver Safety</h1>

        </div>

        <div class="show-content">

            <h1>Current Penaltypoints</h1>
            <p>{{ $currentPenaltypoints }}</p>


            <h1>Total Penaltypoints</h1>
            <p>{{ $totalPenaltypoints }}</p>

            <h1>Penaltypoints per race</h1>
            <p>{{ $penaltypointsPerRace }}</p>

        </div>
    </div>

    <div class="show-container">

        <div class="table-header">

            <h1>Driver Availability</h1>

        </div>

        <div class="show-content">

            <h1>Accepted Availability</h1>
            <p>{{ $acceptedAvailability }}</p>

            <h1>Tentative Availability</h1>
            <p>{{ $tentativeAvailability }}</p>

            <h1>Declined Availability</h1>
            <p>{{ $declinedAvailability }}</p>

            <h1>No response Availability</h1>
            <p>{{ $noResponseAvailability }}</p>

        </div>
    </div>

@endsection
