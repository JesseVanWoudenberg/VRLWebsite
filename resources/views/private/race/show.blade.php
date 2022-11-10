@extends('layouts.private-layout')

@section('page-title') Race - Show @endsection

@section('page') race-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show Race</h1>

        </div>

        <div class="race-container">

            <h1>Race Info</h1>

            <table>
                <tr>
                    <th>Tier</th>
                    <th>Season</th>
                    <th>Round</th>
                    <th>Race format</th>
                    <th>Track</th>
                </tr>

                <tr>
                    <td>{{ $race->tier->tiernumber }}</td>
                    <td>{{ $race->season->seasonnumber }}</td>
                    <td>{{ $race->round }}</td>
                    <td>{{ $race->raceformat->format }}</td>
                    <td>{{ $race->track->name }}</td>
                </tr>
            </table>
        </div>

        @if($fastestlap != null)
            <div class="fastest-lap-container">

                <h1>Fastest Lap</h1>

                <table>
                    <tr>
                        <th>Fastest lap</th>
                        <th>Driver</th>
                        <th>Team</th>
                    </tr>

                    <tr>
                        <td>{{ $fastestlap->laptime }}</td>
                        <td>{{ $fastestlap->driver->name }}</td>
                        <td>{{ $fastestlap->team->name }}</td>
                    </tr>
                </table>
            </div>
        @endif

        @if($race_drivers->count() > 0)
            <div class="drivers-container">

                <h1>Race Results</h1>

                <table>
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>DNF</th>
                            <th>Team</th>
                            <th>Driver</th>
                        </tr>
                    </thead>

                    <tbody>
                       @foreach($race_drivers as $race_driver)
                           <tr>
                               <td>{{ $race_driver->position }}</td>
                               <td> @if($race_driver->dnf == 1 ) Yes @else No @endif</td>
                               <td>{{ $race_driver->team->name }}</td>
                               <td>{{ $race_driver->driver->name }}</td>
                           </tr>
                       @endforeach
                    </tbody>

                </table>
            </div>
        @endif

        <div class="qualifying-container">

            @if(isset($fullqualifyingdrivers))
                @if($fullqualifyingdrivers->count() > 0)

                    <h1>Qualifying Results</h1>

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

                        <tbody class="full-qualifying-body">
                            @foreach($fullqualifyingdrivers as $fullqualifyingdriver)
                                <tr>
                                    <td>{{ $fullqualifyingdriver->driver->name }}</td>
                                    <td>{{ $fullqualifyingdriver->team->name }}</td>
                                    <td>{{ $fullqualifyingdriver->q1 }}</td>
                                    <td>{{ $fullqualifyingdriver->q1laptime }}</td>
                                    <td><img src="{{ asset('resources/media/tyres/' .  strtolower($fullqualifyingdriver->q1tyre) . ".png") }}" alt=""></td>
                                    <td>{{ $fullqualifyingdriver->q2 }}</td>
                                    <td>{{ $fullqualifyingdriver->q2laptime }}</td>
                                    <td><img src="{{ asset('resources/media/tyres/' .  strtolower($fullqualifyingdriver->q2tyre) . ".png") }}" alt=""></td>
                                    <td>{{ $fullqualifyingdriver->q3 }}</td>
                                    <td>{{ $fullqualifyingdriver->q3laptime }}</td>
                                    <td><img src="{{ asset('resources/media/tyres/' .  strtolower($fullqualifyingdriver->q3tyre) . ".png") }}" alt=""></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @else
                @if($shortqualifyingdrivers->count() > 0)

                    <h1>Qualifying Results</h1>

                    <table>
                        <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Team</th>
                                <th>Position</th>
                                <th>Laptime</th>
                                <th>Tyre</th>
                            </tr>
                        </thead>

                        <tbody class="short-qualifying-body">
                            @foreach($shortqualifyingdrivers as $shortqualifyingdriver)
                                <tr>
                                    <td>{{ $shortqualifyingdriver->driver->name }}</td>
                                    <td>{{ $shortqualifyingdriver->team->name }}</td>
                                    <td>{{ $shortqualifyingdriver->position }}</td>
                                    <td>{{ $shortqualifyingdriver->laptime }}</td>
                                    <td><img src="{{ asset('resources/media/tyres/' .  strtolower($shortqualifyingdriver->tyre) . ".png") }}" alt=""></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
        </div>
    </div>

@endsection
