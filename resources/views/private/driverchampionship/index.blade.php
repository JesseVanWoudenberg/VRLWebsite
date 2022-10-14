@extends('layouts.private-layout')

@section('page-title') Driver Championship - Index @endsection

@section('page') driverchampionship-index @endsection

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

    <div class="driverchampionship-list-container">

        <h1><a href="{{ route('driverchampionship.create') }}">Add new driver championship</a></h1>

        <table>

            <thead>
            <tr>
                <th>Driver</th>
                <th>Team</th>
                <th>Season</th>
                <th>Tier</th>
            </tr>
            </thead>

            <tbody>
            @foreach($driverchampionships as $driverchampionship)
                <tr>
                    <td><a href="{{ route('driver.show', ['driver' => $driverchampionship->driver->id]) }}">{{ $driverchampionship->driver->name }}</a></td>
                    <td><a href="{{ route('team.show', ['team' => $driverchampionship->team->id]) }}">{{ $driverchampionship->team->name }}</a></td>
                    <td><a href="{{ route('season.show', ['season' => $driverchampionship->season->id]) }}">{{ $driverchampionship->season->seasonnumber }}</a></td>
                    <td>{{ $driverchampionship->tier->tiernumber }}</td>
                    <td><a href="{{ route('driverchampionship.show', ['driverchampionship' => $driverchampionship->id]) }}">More info</a></td>
                    <td><a href="{{ route('driverchampionship.edit', ['driverchampionship' => $driverchampionship->id]) }}">Edit</a></td>
                    <td><a href="{{ route('driverchampionship.delete', ['driverchampionship' => $driverchampionship->id]) }}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $driverchampionships->render() }}

    </div>

@endsection
