@extends('layouts.error-page-layout')

@section('page-title') 403 - Forbidden @endsection

@section('page') error-403 @endsection

@section('content')

    <div class="message-container-403">
        <h1>403 - Forbidden Access</h1>

        <p><a href="{{ route('home') }}">Back to home</a></p>
    </div>

@endsection
