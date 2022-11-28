@php use Illuminate\Support\Facades\Session; @endphp
@extends('layouts.private-layout')

@section('page-title')
    Race - Index
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
                <h1>Manage Races</h1>
            @endif

            <div class="index-buttons-container">
                <a href="{{ route('race.create') }}">
                    <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                    Add new race
                </a>
            </div>
        </div>

        <div class="table-wrapper-container">
            <table>
                <thead>
                <tr>
                    <th>Track</th>
                    <th>Status</th>
                    <th>Round</th>
                    <th>Season</th>
                    <th>Tier</th>
                </tr>
                </thead>

                <tbody>
                @foreach($races as $race)
                    <tr>
                        <td>
                            <a href="{{ route('track.show', ['track' => $race->track->id]) }}">{{ $race->track->name }}</a>
                        </td>
                        @if($race->done)
                            <td>Done</td>
                        @else
                            <td>DNS</td>
                        @endif
                        <td>{{ $race->round }}</td>
                        <td>
                            <a href="{{ route('season.show', ['season' => $race->season->id]) }}">{{ $race->season->seasonnumber }}</a>
                        </td>
                        <td>{{ $race->season->tier->tiernumber }}</td>
                        <td class="info-button">
                            <a href="{{ route('race.show', ['race' => $race->id]) }}">
                                <img src="{{ asset('resources/media/svgs/info-circle-fill.svg') }}" alt="X">
                                More info
                            </a>
                        </td>

                        <td class="edit-button">
                            <a href="{{ route('race.edit', ['race' => $race->id]) }}">
                                <img src="{{ asset('resources/media/svgs/pencil-fill.svg') }}" alt="X">
                                Edit
                            </a>
                        </td>

                        <td class="delete-button">
                            <a href="{{ route('race.delete', ['race' => $race->id]) }}">
                                <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{--        {{ $races->render() }}--}}

    </div>

@endsection
