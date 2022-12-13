@extends('layouts.private-layout')

@section('page-title') Log - Show @endsection

@section('page') private-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show Article</h1>

        </div>

        <div class="show-content">

            <h1>ID</h1>
            <p>{{ $log->id }}</p>

            <h1>User</h1>
            <p><a href="{{ route('user.show', ['user' => $log->user->id]) }}">{{ $log->user->name }}</a></p>

            <h1>Action</h1>
            <p>{{ $log->action }}</p>

            <h1>Created At</h1>
            <p>{{ $log->created_at }}</p>

        </div>
    </div>

@endsection
