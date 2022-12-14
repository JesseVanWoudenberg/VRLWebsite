@extends('layouts.public-layout')

@section('page-title') Driver - {{ $driver->name }} @endsection

@section('page') driver-show @endsection

@section('content')

    <div class="open-info-container">

        <div class="personal-info">

            <h1>Driver info</h1>

            <table>

                <tbody>

                    <tr>
                        <th>Name</th>
                        <td>{{ $driver->name }}</td>
                    </tr>

                    <tr>
                        <th>Team</th>
                        @if($driver->team->name != 'Reserves' && $driver->team->name != 'None')
                            <td class="{{ strtolower(str_replace(' ', '', $driver->team->name)) }}"><a href="{{ route('open-team', ['team' => $driver->team->id]) }}">{{ $driver->team->name }}</a>
                        @else
                            <td>{{ $driver->team->name }}</td>
                        @endif
                    </tr>

                    <tr>
                        <th>Nationality</th>
                        <td>{{ $driver->nationality }}</td>
                    </tr>

                    <tr>
                        <th>Driver nr.</th>
                        <td>{{ $driver->drivernumber }}</td>
                    </tr>

                    <tr>
                        <th>Tier</th>
                        <td>{{ $driver->tier->tiernumber }}</td>
                    </tr>

                </tbody>
            </table>
        </div>


        <div class="career-details">

            <h1>Career stats</h1>

            <table>
                <tbody>

                    @if(\App\Models\Racedriver::all()->where('driver_id', $driver->id)->where('position', 1)->where('dnf', 0)->count() > 0)
                        <tr>
                            <th>Wins</th>
                            <td>{{ \App\Models\Racedriver::all()->where('driver_id', $driver->id)->where('position', 1)->where('dnf', 0)->count() }}</td>
                        </tr>
                    @else

                        <tr>
                            <th>Highest finishing position</th>
                            <td>{{ "p" . \App\Models\Racedriver::all()->where('driver_id', $driver->id)->where('dnf', 0)->min('position') . " (" . \App\Models\Racedriver::all()->where('driver_id', $driver->id)->where('dnf', 0)->where('position', \App\Models\Racedriver::all()->where('driver_id', $driver->id)->where('dnf', 0)->min('position'))->count() . "x)" }}</td>
                        </tr>

                    @endif

                    @if(\App\Models\Qualifyingdriver::all()->where('driver_id', $driver->id)->where('dnf', 0)->where('q3', 1)->count() > 0 || \App\Models\Shortqualifyingdriver::all()->where('driver_id', $driver->id)->where('position', 1)->count() > 0)
                        <tr>
                            <th>Poles</th>
                            <td>{{ \App\Models\Qualifyingdriver::all()->where('driver_id', $driver->id)->where('q3', 1)->count() + \App\Models\Shortqualifyingdriver::all()->where('driver_id', $driver->id)->where('position', 1)->count()}}</td>
                        </tr>
                    @else

                        <tr>
                            <th>Highest grid position</th>
                            <td>{{ "p" . $highestPosition . " (" . $highestPositionAmount . "x)" }}</td>
                        </tr>

                    @endif

                    @if(\App\Models\Racedriver::all()->where('driver_id', $driver->id)->where('position', '<', 4)->where('dnf', 0)->count() > 0)
                        <tr>
                            <th>Podiums</th>
                            <td>{{ \App\Models\Racedriver::all()->where('driver_id', $driver->id)->where('dnf', 0)->where('position', '<', 4)->count() }}</td>
                        </tr>
                    @endif

                    @if(\App\Models\Fastestlap::all()->where('driver_id', $driver->id)->count() > 0)
                        <tr>
                            <th>Fastest laps</th>
                            <td>{{ \App\Models\Fastestlap::all()->where('driver_id', $driver->id)->count() }}</td>
                        </tr>
                    @endif

                    <tr>
                        <th>Race starts</th>
                        <td>{{ \App\Models\Racedriver::all()->where('driver_id', $driver->id)->count() }}</td>
                    </tr>

                    <tr>
                        <th>Total points</th>
                        <td>{{ $totalpoints }}</td>
                    </tr>

                    <tr>
                        <th>WDC's</th>
                        <td>{{ \App\Models\Driverchampionship::all()->where('driver_id', $driver->id)->count()  }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

@endsection
