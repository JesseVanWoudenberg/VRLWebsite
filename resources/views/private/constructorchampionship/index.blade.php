@extends('layouts.private-layout')

@section('page-title') Constructor Championship - Index @endsection

@section('page') constructorchampionship-index @endsection

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

    <div class="constructorchampionship-list-container">

        <h1><a href="{{ route('constructorchampionship.create') }}">Add new driver championship</a></h1>

        <table>

            <thead>
            <tr>
                <th>Team</th>
                <th>Season</th>
                <th>Tier</th>
            </tr>
            </thead>

            <tbody>
            @foreach($constructorchampionships as $constructorchampionship)
                <tr>
                    <td><a href="{{ route('team.show', ['team' => $constructorchampionship->team->id]) }}">{{ $constructorchampionship->team->name }}</a></td>
                    <td><a href="{{ route('season.show', ['season' => $constructorchampionship->season->id]) }}">{{ $constructorchampionship->season->seasonnumber }}</a></td>
                    <td>{{ $constructorchampionship->tier->tiernumber }}</td>
                    <td><a href="{{ route('constructorchampionship.show', ['constructorchampionship' => $constructorchampionship->id]) }}">More info</a></td>
                    <td><a href="{{ route('constructorchampionship.edit', ['constructorchampionship' => $constructorchampionship->id]) }}">Edit</a></td>
                    <td><a href="{{ route('constructorchampionship.delete', ['constructorchampionship' => $constructorchampionship->id]) }}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $constructorchampionships->render() }}

    </div>

@endsection
