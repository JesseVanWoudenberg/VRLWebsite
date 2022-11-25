@extends('layouts.private-layout')

@section('page-title') Driver Championship - Index @endsection

@section('page') private-index @endsection

@section('content')

    <div class="index-list-container">

        <div class="table-header">

            @if(\Illuminate\Support\Facades\Session::exists('status'))
                <h1 @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'create')) class="created" @endif
                @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'delete')) class="deleted" @endif
                    @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'updated')) class="edited" @endif>
                    {{ \Illuminate\Support\Facades\Session::get('status') }}
                </h1>
            @else
                <h1>Manage WDC's</h1>
            @endif

            <div class="index-buttons-container">
                <a href="{{ route('driverchampionship.create') }}">
                    <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                    Add new driver championship
                </a>
            </div>
        </div>

        <div class="table-wrapper-container">
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
                        <td class="info-button">
                            <a href="{{ route('driverchampionship.show', ['driverchampionship' => $driverchampionship->id]) }}">
                                <img src="{{ asset('resources/media/svgs/info-circle-fill.svg') }}" alt="X">
                                More info
                            </a>
                        </td>

                        <td class="edit-button">
                            <a href="{{ route('driverchampionship.edit', ['driverchampionship' => $driverchampionship->id]) }}">
                                <img src="{{ asset('resources/media/svgs/pencil-fill.svg') }}" alt="X">
                                Edit
                            </a>
                        </td>

                        <td class="delete-button">
                            <a href="{{ route('driverchampionship.delete', ['driverchampionship' => $driverchampionship->id]) }}">
                                <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $driverchampionships->render() }}

    </div>

@endsection
