@extends('layouts.private-layout')

@section('page-title') Team - Show @endsection

@section('page') private-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show Team</h1>

        </div>

        <div class="show-content">

            <h1>Team name</h1>
            <p>{{ $team->name }}</p>

            <h1>Power unit</h1>
            <p><a href="{{ route('powerunit.show', ['powerunit' => $team->powerunit->id]) }}">{{ $team->powerunit->name }}</a></p>

            <h1>Drivers</h1>

            <ul>
                @if($drivers->count() > 0)
                    @foreach($drivers as $driver)
                        <li>{{ $driver->name }}</li>
                    @endforeach
                @else
                    <li>None</li>
                @endif
            </ul>

        </div>
    </div>

@endsection
