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

        </div>
    </div>

@endsection
