@extends('layouts.public-layout')

@section('page-title') Home @endsection

@section('page') homepage @endsection

@section('content')

    <div class="homepage-picture-container">
        <img src="{{ asset('resources/media/VRL_Background.png') }}" alt="Picture not found!">
    </div>

@endsection
