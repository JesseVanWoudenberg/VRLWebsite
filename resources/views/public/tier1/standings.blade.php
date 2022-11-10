@extends('layouts.public-layout')

@section('page-title') Tier 1 - Standings @endsection

@section('page') standings @endsection

@section('content')

{{--    <div class="title-container">--}}
{{--        <h1>Tier 1 Standings</h1>--}}
{{--    </div>--}}

    <div class="buttons-container">
        <button class="button" id="season-previous-button">Driver Standings</button>
        <button class="button" id="season-next-button">Team Standings</button>
    </div>

    <div class="standings-container driver-seasons-container">

        <div class="buttons-container">
            <button class="button" id="driver-previous-button">Previous</button>
            <button class="button" id="driver-next-button">Next</button>
        </div>

        @foreach($allDriverSeasons as $driverSeason)

            <div class="standings-driver-table-container">

                <h1>Season {{ $loop->index + 1 }}</h1>

                <table>
                    <thead>
                        <tr>
                            <th>WDC Pos.</th>
                            <th>Driver</th>
                            <th>Current Team</th>
                            <th>Pts.</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($driverSeason as $driver)

                            <tr>

                                <td
                                    @if(($loop->index + 1) === 1) class="p1" @endif
                                    @if(($loop->index + 1) === 2) class="p2" @endif
                                    @if(($loop->index + 1) === 3) class="p3" @endif
                                >{{ $loop->index + 1 }}</td>

                                <td><a href="{{ route('open-driver', ['driver' => $driver->id]) }}">{{ $driver->name }}</a></td>
                                <td class="{{ strtolower(str_replace(' ', '', $driver->team->name)) }}"><a href="{{ route('open-team', ['team' => $driver->team->id]) }}">{{ $driver->team->name }}</a></td>

                                @if($driver->points > 0 )

                                    <td>{{ $driver->points }}</td>

                                @else

                                    <td>0</td>

                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>

    <div class="standings-container team-seasons-container">

        <div class="buttons-container">
            <button class="button" id="team-previous-button">Previous</button>
            <button class="button" id="team-next-button">Next</button>
        </div>

        @foreach($allTeamsSeason as $teamSeason)

            <div class="standings-teams-table-container">

                <h1>Season {{ $loop->index + 1 }}</h1>

                <table>
                    <thead>
                        <tr>
                            <th>WCC Pos.</th>
                            <th>Team</th>
                            <th>Pts.</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($teamSeason as $team)

                            @if($team->name == "Reserves" or $team->name == "None")
                                @continue
                            @endif

                                <tr>

                                    <td>{{ $loop->index + 1 }}</td>
                                    <td class="{{ strtolower(str_replace(' ', '', $team->name)) }}"><a href="{{ route('open-team', ['team' => $team->id]) }}">{{ $team->name }}</a></td>
                                    <td>{{ $team->points }}</td>

                                </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>

        @endforeach

    </div>

    <script src="{{ asset('resources/javascript/standings-carousel.js') }}"></script>

@endsection
