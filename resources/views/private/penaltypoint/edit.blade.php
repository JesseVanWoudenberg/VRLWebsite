@extends('layouts.private-layout')

@section('page-title') Penalty Points - Edit @endsection

@section('page') user-permission @endsection

@section('content')

{{--    {{ dd($penaltypoints) }}--}}

    <div class="user-permissions-page-container role-permissions-page-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Penalty point edit - {{ $penaltypoints->count() }} Points</h1>
            @endif
        </div>

        <div class="user-permissions-form">

            <form action="{{ route('penaltypoint.update', ['driver' => $driver->id]) }}" method="GET">

                @method('PUT')
                @csrf

                <div class="perms-container">

                    <h1>{{ $driver->name }}</h1>
                    <ul>
                        @foreach($penaltypoints as $penaltypoint)
                            <li>
                                <div class="permission penaltypoint">
                                    <input type="checkbox" name="penaltypoint-{{ $penaltypoint->id }}" value="penaltypoint-{{ $penaltypoint->id }}" id="penaltypoint-{{ $penaltypoint->id }}">
                                    <label for="penaltypoint-{{ $penaltypoint->id }}">{{ $penaltypoint->racesleft }} Races Left</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <input type="submit" value="Remove Penalty Points">
            </form>
        </div>
    </div>

@endsection
