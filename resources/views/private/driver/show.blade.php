@extends('layouts.private-layout')

@section('page-title') Driver - Show @endsection

@section('page') driver-show @endsection

@section('content')

    <div class="show-container">
        <table>
            <tr>
                <th>Name</th>
                <td>{{ $driver->name }}</td>
            </tr>

            <tr>
                <th>Nationality</th>
                <td>{{ $driver->nationality }}</td>
            </tr>

            <tr>
                <th>Driver number</th>
                <td>{{ $driver->drivernumber }}</td>
            </tr>

            <tr>
                <th>Team</th>
                <td><a href="{{ route('team.show', ['team' => $driver->team->id]) }}">{{ $driver->team->name }}</a></td>
            </tr>

            <tr>
                <th>Tier</th>
                <td>{{ $driver->tier->tiernumber }}</td>
            </tr>
        </table>
    </div>

@endsection
