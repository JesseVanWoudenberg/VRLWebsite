@extends('layouts.private-layout')

@section('page-title') Driver - Index @endsection

@section('page') driver-index @endsection

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

    <div class="driver-list-container">

        <h1><a href="{{ route('driver.create') }}">Add new driver</a></h1>

        <table>

            <thead>
            <tr>
                <th>Name</th>
                <th>Team</th>
                <th>Tier</th>
            </tr>
            </thead>

            <tbody>
                @foreach($drivers as $driver)
                    <tr>
                        <td>{{ $driver->name }}</td>
                        <td><a href="{{ route('team.show', ['team' => $driver->team->id]) }}">{{ $driver->team->name }}</a></td>
                        <td>{{ $driver->tier->tiernumber }}</td>
                        <td><a href="{{ route('driver.show', ['driver' => $driver->id]) }}">More info</a></td>
                        <td><a href="{{ route('driver.edit', ['driver' => $driver->id]) }}">Edit</a></td>
                        <td><a href="{{ route('driver.delete', ['driver' => $driver->id]) }}">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $drivers->render() }}

    </div>

@endsection
