@extends('layouts.private-layout')

@section('page-title') Constructor Championship - Index @endsection

@section('page') constructorchampionship-index private-index @endsection

@section('content')

    @if ($errors->any())
        <div>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif


    <div class="index-list-container">

        <div class="table-header">

            @if(\Illuminate\Support\Facades\Session::exists('status'))
                <h1 @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'create')) class="created" @endif
                @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'delete')) class="deleted" @endif
                    @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'updated')) class="edited" @endif>
                    {{ \Illuminate\Support\Facades\Session::get('status') }}
                </h1>
            @else
                <h1>Manage WCC's</h1>
            @endif

            <div class="index-buttons-container">
                <a href="{{ route('constructorchampionship.create') }}">
                    <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                    Add new constructors championship
                </a>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Team</th>
                    <th>Season</th>
                    <th>Tier</th>
                </tr>
            </thead>

            <tbody>
                @foreach($constructorchampionships as $constructorchampionship)
                    <tr>
                        <td>{{ $constructorchampionship->id }}</td>
                        <td><a href="{{ route('team.show', ['team' => $constructorchampionship->team->id]) }}">{{ $constructorchampionship->team->name }}</a></td>
                        <td>{{ $constructorchampionship->season->seasonnumber }}</td>
                        <td>{{ $constructorchampionship->tier->tiernumber }}</td>
                        <td class="info-button">
                            <a href="{{ route('constructorchampionship.show', ['constructorchampionship' => $constructorchampionship->id]) }}">
                                <img src="{{ asset('resources/media/svgs/info-circle-fill.svg') }}" alt="X">
                                More info
                            </a>
                        </td>

                        <td class="edit-button">
                            <a href="{{ route('constructorchampionship.edit', ['constructorchampionship' => $constructorchampionship->id]) }}">
                                <img src="{{ asset('resources/media/svgs/pencil-fill.svg') }}" alt="X">
                                Edit
                            </a>
                        </td>

                        <td class="delete-button">
                            <a href="{{ route('constructorchampionship.delete', ['constructorchampionship' => $constructorchampionship->id]) }}">
                                <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $constructorchampionships->render() }}

    </div>

@endsection
