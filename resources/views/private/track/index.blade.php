@extends('layouts.private-layout')

@section('page-title') Track - Index @endsection

@section('page') track-index @endsection

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

    <div class="track-list-container">

        <h1><a href="{{ route('track.create') }}">Add new track</a></h1>

        <table>

            <thead>
            <tr>
                <th>TRACK NAME</th>
                <th>COUNTRY</th>
            </tr>
            </thead>

            <tbody>
            @foreach($tracks as $track)
                <tr>
                    <td>{{ $track->name }}</td>
                    <td>{{ $track->country }}</td>
                    <td><a href="{{ route('track.show', ['track' => $track->id]) }}">More info</a></td>
                    <td><a href="{{ route('track.edit', ['track' => $track->id]) }}">Edit</a></td>
                    <td><a href="{{ route('track.delete', ['track' => $track->id]) }}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>

        </table>

        {{ $tracks->links() }}

    </div>

@endsection
