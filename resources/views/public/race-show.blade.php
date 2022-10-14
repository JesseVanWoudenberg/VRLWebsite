@extends('layouts.public-layout')

@section('page-title') Race result @endsection

@section('page') open-race-show @endsection

@section('content')

    <div>
        <div class="open-race-info-container">

            <h1>Race info</h1>

            <table>
                <thead>
                    <tr>
                        <th>Round</th>
                        <th>Track</th>
                        <th>Season</th>
                        <th>Tier</th>
                        <th>Race format</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{ $race->round }}</td>
                        <td>{{ $race->track->name }}</td>
                        <td>{{ $race->season->seasonnumber }}</td>
                        <td>{{ $race->tier->tiernumber }}</td>
                        <td>{{ $race->raceformat->format }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="buttons-container">

                <button id="fastest-lap-show-button">Fastest Lap</button>
                <button id="race-results-show-button">Race results</button>

                @if(isset($fullqualifyingdrivers))
                    <button id="full-qualifying-show-button">Full Qualifying Results</button>
                @elseif(isset($shortqualifyingdrivers))
                    <button id="short-qualifying-show-button">Short Qualifying Results</button>
                @endif
            </div>
        </div>

        @if(isset($fastestlap))
            <div class="open-fastest-lap-container results-container">

                <h1>Fastest lap</h1>

                <table>
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th>Team</th>
                            <th>Laptime</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><a href="{{ route('open-driver', ['driver' => $fastestlap->driver->id]) }}">{{ $fastestlap->driver->name }}</a></td>
                            <td class="{{ strtolower(str_replace(' ', '', $fastestlap->team->name)) }}"><a href="{{ route('open-team', ['team' => $fastestlap->team->id]) }}">{{ $fastestlap->team->name }}</a></td>
                            <td>{{ $fastestlap->laptime }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        @endif

        @if(isset($racedrivers))
            <div class="race-results-container results-container">

                <h1>Race results</h1>

                <table>
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>Driver</th>
                            <th>Team</th>
                            <th>Dnf</th>
                        </tr>
                    </thead>

                    @foreach($racedrivers as $racedriver)

                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><a href="{{ route('open-driver', ['driver' => $racedriver->driver->id]) }}">{{ $racedriver->driver->name }}</a></td>
                            <td class="{{ strtolower(str_replace(' ', '', $racedriver->team->name)) }}"><a href="{{ route('open-team', ['team' => $racedriver->team->id]) }}">{{ $racedriver->team->name }}</a></td>
                            @if($racedriver->dnf == 1)
                                <td>Yes</td>
                            @else
                                <td>No</td>
                            @endif
                        </tr>

                    @endforeach
                </table>
            </div>
        @endif

        @if(isset($fullqualifyingdrivers))

            <div class="full-qualifying-results-container results-container">

                <h1>Full Qualifying Results</h1>

                <table>
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th>Team</th>
                            <th>Q1</th>
                            <th>Q1 Time</th>
                            <th>Q1 Tyre</th>
                            <th>Q2</th>
                            <th>Q2 Time</th>
                            <th>Q2 Tyre</th>
                            <th>Q3</th>
                            <th>Q3 Time</th>
                            <th>Q3 Tyre</th>
                        </tr>
                    </thead>

                    @foreach($fullqualifyingdrivers as $fullqualifyingdriver)
                        <tr>
                            <td><a href="{{ route('open-driver', ['driver' => $fullqualifyingdriver->driver->id]) }}">{{ $fullqualifyingdriver->driver->name }}</a></td>
                            <td class="{{ strtolower(str_replace(' ', '', $fullqualifyingdriver->team->name)) }}"><a href="{{ route('open-team', ['team' => $fullqualifyingdriver->team->id]) }}">{{ $fullqualifyingdriver->team->name }}</a></td>
                            @if($fullqualifyingdriver->q1 != 100)
                                <td>{{ $fullqualifyingdriver->q1 }}</td>
                                <td>{{ $fullqualifyingdriver->q1laptime }}</td>
                                <td><img src="{{ asset('resources/media/tyres/' .  strtolower($fullqualifyingdriver->q1tyre) . ".png") }}" alt=""></td>

                                    @if($fullqualifyingdriver->q2 != 100)
                                        <td>{{ $fullqualifyingdriver->q2 }}</td>
                                    <td>{{ $fullqualifyingdriver->q2laptime }}</td>
                                    <td><img src="{{ asset('resources/media/tyres/' .  strtolower($fullqualifyingdriver->q2tyre) . ".png") }}" alt=""></td>
                                    @if($fullqualifyingdriver->q3 != 100)
                                        <td>{{ $fullqualifyingdriver->q3 }}</td>
                                    <td>{{ $fullqualifyingdriver->q3laptime }}</td>
                                    <td><img src="{{ asset('resources/media/tyres/' .  strtolower($fullqualifyingdriver->q3tyre) . ".png") }}" alt=""></td>

                                    @else
                                        <td>DNF</td>
                                    @endif
                                @else
                                    <td>DNF</td>
                                @endif
                            @else
                                <td>DNF</td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif

        @if(isset($shortqualifyingdrivers))
            <div class="short-qualifying-results-container results-container">

                <h1>Short Qualifying Results</h1>

                <table>
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>Driver</th>
                            <th>Team</th>
                            <th>Laptime</th>
                            <th>Tyre</th>

                        </tr>
                    </thead>

                    @foreach($shortqualifyingdrivers as $shortqualifyingdriver)

                        <tr>
                            <td>{{ $shortqualifyingdriver->position }}</td>
                            <td><a href="{{ route('open-driver', ['driver' => $shortqualifyingdriver->driver->id]) }}">{{ $shortqualifyingdriver->driver->name }}</a></td>
                            <td class="{{ strtolower(str_replace(' ', '', $shortqualifyingdriver->team->name)) }}"><a href="{{ route('open-team', ['team' => $shortqualifyingdriver->team->id]) }}">{{ $shortqualifyingdriver->team->name }}</a></td>
                            <td>{{ $shortqualifyingdriver->laptime }}</td>
                            <td><img src="{{ asset('resources/media/tyres/' .  strtolower($shortqualifyingdriver->tyre) . ".png") }}" alt=""></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif


    </div>

    <script src="{{ asset('resources/javascript/race-results-carousel.js') }}"></script>

@endsection
