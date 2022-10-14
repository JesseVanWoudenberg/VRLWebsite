@extends('layouts.private-layout')

@section('page-title') Team - Index @endsection

@section('page') team-index @endsection

@section('content')

    @if ($errors->any())
        <div>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    @if(\Illuminate\Support\Facades\Session::exists('status'))
        <div class="message
            @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'create')) created @endif
        @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'delete')) deleted @endif
            ">
            {{ \Illuminate\Support\Facades\Session::get('status') }}
        </div>
    @endif

    <div class="team-list-container">

        <h1><a href="{{ route('team.create') }}">Add new team</a></h1>

        <table>

            <thead>
            <tr>
                <th>Team Name</th>
                <th>Powerunit</th>
            </tr>
            </thead>

            <tbody>
                @foreach($teams as $team)
                    <tr>
                        <td>{{ $team->name }}</td>
                        <td><a href="{{ route('powerunit.show', ['powerunit' => $team->powerunit->id]) }}">{{ $team->powerunit->name }}</a></td>
                        <td><a href="{{ route('team.show', ['team' => $team->id]) }}">More info</a></td>
                        <td><a href="{{ route('team.edit', ['team' => $team->id]) }}">Edit</a></td>
                        <td><a href="{{ route('team.delete', ['team' => $team->id]) }}">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
