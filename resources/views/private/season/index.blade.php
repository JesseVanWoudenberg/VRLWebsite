@extends('layouts.private-layout')

@section('page-title') Season - Index @endsection

@section('page') season-index @endsection

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

    <div class="season-list-container">

        <h1><a href="{{ route('season.create') }}">Add new season</a></h1>

        <table>

            <thead>
            <tr>
                <th>SEASON NUMBER</th>
                <th>TIER ID</th>
            </tr>
            </thead>

            <tbody>
                @foreach($seasons as $season)
                    <tr>
                        <td>{{ $season->seasonnumber }}</td>
                        <td>{{ $season->tier->tiernumber }}</td>
                        <td><a href="{{ route('season.show', ['season' => $season->id]) }}">More info</a></td>
                        <td><a href="{{ route('season.edit', ['season' => $season->id]) }}">Edit</a></td>
                        <td><a href="{{ route('season.delete', ['season' => $season->id]) }}">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{ $seasons->render() }}

    </div>

@endsection
