@extends('layouts.private-layout')

@section('page-title') Race - Index @endsection

@section('page') race-index @endsection

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

    <div class="race-list-container">

        <h1><a href="{{ route('race.create') }}">Add new race</a></h1>

        <table>

            <thead>
            <tr>
                <th>TRACK NAME</th>
                <th>SEASON NUMBER</th>
                <th>TIER NUMBER</th>
            </tr>
            </thead>

            <tbody>
            @foreach($races as $race)
                <tr>
                    <td><a href="{{ route('track.show', ['track' => $race->track->id]) }}">{{ $race->track->name }}</a></td>
                    <td><a href="{{ route('season.show', ['season' => $race->season->id]) }}">{{ $race->season->seasonnumber }}</a></td>
                    <td>{{ $race->season->tier->tiernumber }}</td>
                    <td><a href="{{ route('race.show', ['race' => $race->id]) }}">More info</a></td>
                    <td><a href="{{ route('race.edit', ['race' => $race->id]) }}">Edit</a></td>
                    <td><a href="{{ route('race.delete', ['race' => $race->id]) }}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>

        </table>

{{--        {{ $seasons->render() }}--}}

    </div>

@endsection
