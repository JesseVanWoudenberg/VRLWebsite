@extends('layouts.public-layout')

@section('page-title') Profile @endsection

@section('page') profile-show @endsection

@section('content')

    <div class="show-profile-container">

        <h1>Hello {{ $user->name }}</h1>

        <table>
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
        </table>

        <div class="edit-profile-link">
            <a href="{{ route('profile.edit', ['profile' => $user->id]) }}">Change Email/password</a>
        </div>

    </div>

@endsection
