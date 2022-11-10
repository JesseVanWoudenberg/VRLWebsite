@extends('layouts.private-layout')

@section('page-title') Power unit - Show @endsection

@section('page') private-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show Power Unit</h1>

        </div>

        <div class="show-content">
            <h1>Power unit name</h1>
            <p>{{ $powerunit->name }}</p>

        <h1>Teams using this power unit</h1>
        @foreach(\App\Models\Team::all()->where('powerunit_id', "=", $powerunit->id) as $team)
            <p>{{ $team->name }}</p>
        @endforeach

        </div>
    </div>

@endsection
