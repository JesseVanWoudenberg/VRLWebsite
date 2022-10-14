@extends('layouts.private-layout')

@section('page-title') Team - Show @endsection

@section('page') team-show @endsection

@section('content')

    <div class="show-container">
        <table>
            <tr>
                <th>Team name</th>
                <td>{{ $team->name }}</td>
            </tr>

            <tr>
                <th>Power unit</th>
                <td><a href="{{ route('powerunit.show', ['powerunit' => $team->powerunit->id]) }}">{{ $team->powerunit->name }}</a></td>
            </tr>
        </table>
    </div>

@endsection
