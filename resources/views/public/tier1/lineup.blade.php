@extends('layouts.public-layout')

@section('page-title') Tier 1 - Lineup @endsection

@section('page') lineup @endsection

@section('content')

{{--    <div class="title-container">--}}
{{--        <h1>Tier 1 driver lineup</h1>--}}
{{--    </div>--}}

    <div class="lineup-table-container">
        <table>
            <tbody>
                @foreach($teams as $team)

                    @if($team->name == "Reserves" or $team->name == "None")
                        @continue
                    @endif

                        <tr>
                            <th class="{{ strtolower(str_replace(' ', '', $team->name)) }}"><a href="{{ route('open-team', ['team' => $team->id]) }}">{{ $team->name }}</a></th>
                        </tr>

                        @foreach($drivers->where('team_id', $team->id) as $driver)

                                <tr>
                                    <td><a href="{{ route('open-driver', ['driver' => $driver->id]) }}">{{ $driver->name }}</a></td>
                                </tr>

                        @endforeach

                @endforeach

                <tr>
                    <th class="reserves">Reserves</th>
                </tr>

                @foreach($drivers->where('team_id', $teams->where('name', 'Reserves')->first()->id) as $driver)

                    <tr>
                        <td><a href="{{ route('open-driver', ['driver' => $driver->id]) }}">{{ $driver->name }}</a></td>
                    </tr>

                @endforeach

            </tbody>
        </table>
    </div>

@endsection
