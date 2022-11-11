@extends('layouts.private-layout')

@section('page-title') User - Show @endsection

@section('page') private-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show User</h1>

        </div>

        <div class="show-content">

            <h1>Name</h1>
            <p>{{ $user->name }}</p>


            <h1>Email</h1>
            <p>{{ $user->email }}</p>

        </div>
    </div>

@endsection
