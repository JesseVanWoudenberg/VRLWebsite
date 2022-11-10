@extends('layouts.private-layout')

@section('page-title') Driver - Index @endsection

@section('page') driver-index private-index @endsection

@section('content')

    <div class="index-list-container">

        <div class="table-header">

            @if(\Illuminate\Support\Facades\Session::exists('status'))
                <h1 @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'create')) class="created" @endif
                @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'delete')) class="deleted" @endif
                    @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'updated')) class="edited" @endif>
                    {{ \Illuminate\Support\Facades\Session::get('status') }}
                </h1>
            @elseif($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Manage Drivers</h1>
            @endif

            <div class="index-buttons-container">
                <a href="{{ route('driver.create') }}">
                    <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                    Add new driver
                </a>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Team</th>
                    <th>Tier</th>
                </tr>
            </thead>

            <tbody>
                @foreach($drivers as $driver)
                    <tr>
                        <td>{{ $driver->id }}</td>
                        <td>{{ $driver->name }}</td>
                        <td><a href="{{ route('team.show', ['team' => $driver->team->id]) }}">{{ $driver->team->name }}</a></td>
                        <td>{{ $driver->tier->tiernumber }}</td>
                        <td class="info-button">
                            <a href="{{ route('driver.show', ['driver' => $driver->id]) }}">
                                <img src="{{ asset('resources/media/svgs/info-circle-fill.svg') }}" alt="X">
                                More info
                            </a>
                        </td>

                        <td class="edit-button">
                            <a href="{{ route('driver.edit', ['driver' => $driver->id]) }}">
                                <img src="{{ asset('resources/media/svgs/pencil-fill.svg') }}" alt="X">
                                Edit
                            </a>
                        </td>

                        <td class="delete-button">
                            <a href="{{ route('driver.delete', ['driver' => $driver->id]) }}">
                                <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $drivers->render() }}

    </div>

@endsection
