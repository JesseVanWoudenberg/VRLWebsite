@extends('layouts.public-layout')

@section('page-title') Tier 1 - Leaderboard @endsection

@section('page') tier-1-leaderboard @endsection

@section('content')

    <div>

        <div class="leaderboard-controls">
            <button class="button" id="points-button">Points</button>
            <button class="button" id="wdc-button">WDC's</button>
            <button class="button" id="wins-button">Wins</button>
            <button class="button" id="podiums-button">Podiums</button>
            <button class="button" id="poles-button">Poles</button>
            <button class="button" id="fastest-laps-button">Fastest Laps</button>
            <button class="button" id="race-starts-button">Race Starts</button>
        </div>

        <div class="leaderboard-container">

            <h1>Points</h1>

            <table>
                <tbody>
                    @foreach($pointsdrivers as $pointsdriver)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $pointsdriver->name }}</td>
                            <td>{{ $pointsdriver->points }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="leaderboard-container">

            <h1>WDC's</h1>

            <table>
                <tbody>
                    @foreach($championshipdrivers as $championshipdriver)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $championshipdriver->name }}</td>
                            <td>{{ $championshipdriver->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="leaderboard-container">

            <h1>Wins</h1>

            <table>
                <tbody>
                    @foreach($windrivers as $windriver)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $windriver->name }}</td>
                            <td>{{ $windriver->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="leaderboard-container">

            <h1>Podiums</h1>

            <table>
                <tbody>
                    @foreach($podiumdrivers as $podiumdriver)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $podiumdriver->name }}</td>
                            <td>{{ $podiumdriver->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="leaderboard-container">

            <h1>Poles</h1>

            <table>
                <tbody>
                    @foreach($poledrivers as $poledriver)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $poledriver->name }}</td>
                            <td>{{ $poledriver->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="leaderboard-container">

            <h1>Fastest laps</h1>

            <table>
                <tbody>
                    @foreach($fastestlapdrivers as $fastestlapdriver)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $fastestlapdriver->name }}</td>
                            <td>{{ $fastestlapdriver->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="leaderboard-container">

            <h1>Race starts</h1>

            <table>
                <tbody>
                    @foreach($racestartdrivers as $racestartdriver)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $racestartdriver->name }}</td>
                            <td>{{ $racestartdriver->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="{{ asset('resources/javascript/leaderboard-carousel.js') }}"></script>

@endsection
