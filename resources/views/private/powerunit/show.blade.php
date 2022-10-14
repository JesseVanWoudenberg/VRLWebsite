@extends('layouts.private-layout')

@section('page-title') Power unit - Show @endsection

@section('page') powerunit-show @endsection

@section('content')

    <div class="show-container">

        <h1>Power unit name</h1>
        <p>{{ $powerunit->name }}</p>

        <ul>
{{--            foreach of teams using this powerunit--}}
        </ul>
    </div>

@endsection
