@php use Illuminate\Support\Facades\Session; @endphp
@extends('layouts.private-layout')

@section('page-title')
    Log - Index
@endsection

@section('page')
    private-index
@endsection

@section('content')

    <div class="index-list-container">

        <div class="table-header">

            @if(Session::exists('status'))
                <h1 @if(Illuminate\Support\Str::contains(Session::get('status'), 'create')) class="created" @endif
                @if(Illuminate\Support\Str::contains(Session::get('status'), 'delete')) class="deleted" @endif
                    @if(Illuminate\Support\Str::contains(Session::get('status'), 'updated')) class="edited" @endif>
                    {{ Session::get('status') }}
                </h1>
            @elseif($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Manage Logs</h1>
            @endif

            <div class="index-buttons-container">
                <a href="{{ route('driver.create') }}">
                    <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                    Add new driver
                </a>
            </div>
        </div>

        <div class="table-wrapper-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->user->name }}</td>
                            <td>{{ $log->action }}</td>

                            <td class="info-button">
                                <a href="{{ route('log.show', ['log' => $log->id]) }}">
                                    <img src="{{ asset('resources/media/svgs/info-circle-fill.svg') }}" alt="X">
                                    More info
                                </a>
                            </td>

    {{--                        <td class="edit-button">--}}
    {{--                            <a href="{{ route('driver.edit', ['driver' => $driver->id]) }}">--}}
    {{--                                <img src="{{ asset('resources/media/svgs/pencil-fill.svg') }}" alt="X">--}}
    {{--                                Edit--}}
    {{--                            </a>--}}
    {{--                        </td>--}}

    {{--                        <td class="delete-button">--}}
    {{--                            <a href="{{ route('driver.delete', ['driver' => $driver->id]) }}">--}}
    {{--                                <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">--}}
    {{--                                Delete--}}
    {{--                            </a>--}}
    {{--                        </td>--}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $logs->render() }}

    </div>

@endsection
