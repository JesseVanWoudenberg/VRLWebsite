@extends('layouts.private-layout')

@section('page-title')
    Availability - Index
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
                <h1>Manage Availability</h1>
            @endif
        </div>

        <div class="table-wrapper-container">
            <table>
                <thead>
                    <tr>
                        <th>Tier</th>
                        <th>Season</th>
                        <th>Round</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($raceAvailabilities as $raceAvailability)
                        <tr>
                            <td>{{ $raceAvailability->race->tier->tiernumber }}</td>
                            <td>{{ $raceAvailability->race->season->seasonnumber }}</td>
                            <td>{{ $raceAvailability->race->round }}</td>
                            <td class="availability-button">
                                <a href="{{ route('admin.availability.show', ['raceAvailabilityId' => $raceAvailability->id]) }}">
                                    Check Availability
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
