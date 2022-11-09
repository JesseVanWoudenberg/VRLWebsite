@extends('layouts.private-layout')

@section('page-title') Track - Show @endsection

@section('page') private-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show Track</h1>
        </div>

        <div class="show-content">

            <h1>Track name</h1>
            <p>{{ $track->name }}</p>

            <h1>Country</h1>
            <p>{{ $track->country }}</p>

            <h1>Length</h1>
            <p>{{ $track->length }}</p>

            <h1>Turns</h1>
            <p>{{ $track->turns }}</p>

        </div>
    </div>

@endsection
