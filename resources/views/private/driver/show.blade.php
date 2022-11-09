@extends('layouts.private-layout')

@section('page-title') Driver - Show @endsection

@section('page') private-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show Article</h1>

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

@endsection
