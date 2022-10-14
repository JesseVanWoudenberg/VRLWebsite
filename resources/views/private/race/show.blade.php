@extends('layouts.private-layout')

@section('page-title') Race - Show @endsection

@section('page') race-show @endsection

@section('content')

    <div class="show-container">
        <div class="race-container">
            <table>
                <tr>
                    <th>Tier</th>
                    <th>Season</th>
                    <th>Race format</th>
                    <th>Round</th>
                    <th>Track</th>
                </tr>

                <tr>
                    <td>{{ $race->tier->tiernumber }}</td>
                    <td>{{ $race->season->seasonnumber }}</td>
                    <td>{{ $race->raceformat->format }}</td>
                    <td>{{ $race->round }}</td>
                    <td>{{ $race->track->name }}</td>
                </tr>
            </table>
        </div>

        <div class="fastest-lap-container">
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

        <div class="drivers-container">
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

        <div class="drivers-container">
            <table>
                @if(isset($fullqualifyingdrivers))
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

                    <tbody>
                        @foreach($fullqualifyingdrivers as $fullqualifyingdriver)
                            <tr>
                                <td>{{ $fullqualifyingdriver->driver->name }}</td>
                                <td>{{ $fullqualifyingdriver->team->name }}</td>
                                <td>{{ $fullqualifyingdriver->q1 }}</td>
                                <td>{{ $fullqualifyingdriver->q1laptime }}</td>
                                <td>{{ $fullqualifyingdriver->q1tyre}}</td>
                                <td>{{ $fullqualifyingdriver->q2 }}</td>
                                <td>{{ $fullqualifyingdriver->q2laptime }}</td>
                                <td>{{ $fullqualifyingdriver->q2tyre }}</td>
                                <td>{{ $fullqualifyingdriver->q3 }}</td>
                                <td>{{ $fullqualifyingdriver->q3laptime }}</td>
                                <td>{{ $fullqualifyingdriver->q3tyre }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                @else

                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th>Team</th>
                            <th>Position</th>
                            <th>Laptime</th>
                            <th>Tyre</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($shortqualifyingdrivers as $shortqualifyingdriver)
                            <tr>
                                <td>{{ $shortqualifyingdriver->driver->name }}</td>
                                <td>{{ $shortqualifyingdriver->team->name }}</td>
                                <td>{{ $shortqualifyingdriver->position }}</td>
                                <td>{{ $shortqualifyingdriver->laptime }}</td>
                                <td>{{ $shortqualifyingdriver->tyre }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>

@endsection
