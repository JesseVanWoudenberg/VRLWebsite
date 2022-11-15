@extends('layouts.private-layout')

@section('page-title') Season - Show @endsection

@section('page') private-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show Season</h1>

        </div>

        <div class="show-content">

            <h1>Season</h1>
            <p>{{ $season->seasonnumber }}</p>

            <h1>Tier</h1>
            <p>{{ $season->tier->tiernumber }}</p>

        </div>
    </div>

@endsection
