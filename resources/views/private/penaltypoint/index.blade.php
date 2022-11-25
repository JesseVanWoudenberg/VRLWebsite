@extends('layouts.private-layout')

@section('page-title') Penalty point - Index @endsection

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
                <h1>Penalty points</h1>
            @endif

            <div class="index-buttons-container">
                <a href="{{ route('penaltypoint.create') }}">
                    <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                    Add new penalty points
                </a>
            </div>
        </div>

        <div class="table-wrapper-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Penalty points</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($drivers as $driver)
                    <tr>
                        <td>{{ $driver->name }}</td>
                        <td>{{ $driver->amount }}</td>

                        <td class="permissions-button">
                            <a href="{{ route('penaltypoint.edit', ['driver' => $driver->id]) }}">
                                <img src="{{ asset('resources/media/svgs/person-lines-fill.svg') }}" alt="X">
                                Manage Penalty points
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
