@extends('layouts.public-layout')

@section('page-title') {{ $track->name }} @endsection

@section('page') track-open @endsection

@section('content')

    <div class="open-track-container">

        <div class="track-map-container">
            <img src="{{ asset('resources/media/trackmaps/' . strtolower(str_replace(" ", "-", $track->name)) . ".png") }}" alt="">
        </div>

        <div class="track-info-container">

            <h1>{{ $track->name }}</h1>

            <table>
                <tr>
                    <th>Country</th>
                    <td>{{ $track->country }}</td>
                </tr>

                <tr>
                    <th>Track Length</th>
                    <td>{{ $track->length }} km</td>
                </tr>

                <tr>
                    <th>Amount of Turns</th>
                    <td>{{ $track->turns }}</td>
                </tr>

                @if($firstgrandprix != null)
                    <tr>
                        <th>First Grand Prix</th>
                        <td>Round {{ $firstgrandprix->round }} <br> (Season: {{ $firstgrandprix->season->seasonnumber }} - Tier: {{ $firstgrandprix->tier->tiernumber }})</td>
                    </tr>
                @else
                    <tr>
                        <th>First Grand Prix</th>
                        <td>N/A</td>
                    </tr>
                @endif
            </table>

        </div>

        <div class="fastest-lap-container">

            <h1>Lap Record</h1>

            @if($fastestLap != null)
                <p>{{ $fastestLap->laptime }} ( Season: {{ $fastestLap->race->season->seasonnumber }} - Tier {{ $fastestLap->race->tier->tiernumber }})</p>
                <p>{{ $fastestLap->driver->name }}</p>
            @else
                <p>N/A</p>
            @endif
        </div>

    </div>

@endsection
