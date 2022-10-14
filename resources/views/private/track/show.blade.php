@extends('layouts.private-layout')

@section('page-title') Track - Show @endsection

@section('page') track-show @endsection

@section('content')

    <div class="show-container">
        <table>
            <tr>
                <th>Track name</th>
                <td>{{ $track->name }}</td>
            </tr>

            <tr>
                <th>Country</th>
                <td>{{ $track->country }}</td>
            </tr>

            <tr>
                <th>Length</th>
                <td>{{ $track->length }}</td>
            </tr>

            <tr>
                <th>Turns</th>
                <td>{{ $track->turns }}</td>
            </tr>
        </table>
    </div>

@endsection
