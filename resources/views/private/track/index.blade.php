@extends('layouts.private-layout')

@section('page-title') Track - Index @endsection

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
            @elseif($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Manage Tracks</h1>
            @endif

            <div class="index-buttons-container">
                <a href="{{ route('track.create') }}">
                    <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                    Add new track
                </a>
            </div>
        </div>

        <div class="table-wrapper-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Length</th>
                        <th>Corners</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tracks as $track)
                        <tr>
                            <td>{{ $track->name }}</td>
                            <td>{{ $track->country }}</td>
                            <td>{{ $track->length }}</td>
                            <td>{{ $track->turns }}</td>

                            <td class="info-button">
                                <a href="{{ route('track.show', ['track' => $track->id]) }}">
                                    <img src="{{ asset('resources/media/svgs/info-circle-fill.svg') }}" alt="X">
                                    More info
                                </a>
                            </td>

                            <td class="edit-button">
                                <a href="{{ route('track.edit', ['track' => $track->id]) }}">
                                    <img src="{{ asset('resources/media/svgs/pencil-fill.svg') }}" alt="X">
                                    Edit
                                </a>
                            </td>

                            <td class="delete-button">
                                <a href="{{ route('track.delete', ['track' => $track->id]) }}">
                                    <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $tracks->links() }}

    </div>

@endsection
