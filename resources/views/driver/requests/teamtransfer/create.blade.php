@extends('layouts.driver-layout')

@section('page-title') Driver - Requests @endsection

@section('page') driver-request-create @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Driver team transfer request</h1>
            @endif
        </div>

        <form action="{{ route('driverpanel.requests.teamtransfer.store') }}" method="GET">

            @csrf

            <label for="team_id">New Team</label>
            <div class="select-container">
                <select name="team_id" id="team_id">
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <label for="reason">Why do you want to move team?</label>
            <textarea name="reason" id="reason" maxlength="500"></textarea>

            <input type="submit" value="Send Request">
        </form>
    </div>

@endsection
