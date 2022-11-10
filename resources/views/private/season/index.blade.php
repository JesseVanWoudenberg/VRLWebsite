@extends('layouts.private-layout')

@section('page-title') Season - Index @endsection

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
                <h1>Manage Seasons</h1>
            @endif

            <div class="index-buttons-container">
                <a href="{{ route('season.create') }}">
                    <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                    Add new season
                </a>
            </div>
        </div>

        <table>

            <thead>
            <tr>
                <th>Season</th>
                <th>Tier</th>
            </tr>
            </thead>

            <tbody>
                @foreach($seasons as $season)
                    <tr>
                        <td>{{ $season->seasonnumber }}</td>
                        <td>{{ $season->tier->tiernumber }}</td>

                        <td class="info-button">
                            <a href="{{ route('season.show', ['season' => $season->id]) }}">
                                <img src="{{ asset('resources/media/svgs/info-circle-fill.svg') }}" alt="X">
                                More info
                            </a>
                        </td>

                        <td class="edit-button">
                            <a href="{{ route('season.edit', ['season' => $season->id]) }}">
                                <img src="{{ asset('resources/media/svgs/pencil-fill.svg') }}" alt="X">
                                Edit
                            </a>
                        </td>

                        <td class="delete-button">
                            <a href="{{ route('season.delete', ['season' => $season->id]) }}">
                                <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{ $seasons->render() }}

    </div>

@endsection
