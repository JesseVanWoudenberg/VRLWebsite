@extends('layouts.public-layout')

@section('page-title') Tier 1 - Lineup @endsection

@section('page') lineup @endsection

@section('content')

{{--    <div class="lineup-table-container">--}}
{{--        <table>--}}
{{--            <tbody>--}}
{{--                @foreach($teams as $team)--}}

{{--                    @if($team->name == "Reserves" or $team->name == "None")--}}
{{--                        @continue--}}
{{--                    @endif--}}

{{--                        <tr>--}}
{{--                            <th class="{{ strtolower(str_replace(' ', '', $team->name)) }}"><a href="{{ route('open-team', ['team' => $team->id]) }}">{{ $team->name }}</a></th>--}}
{{--                        </tr>--}}

{{--                        @foreach($drivers->where('team_id', $team->id) as $driver)--}}

{{--                                <tr>--}}
{{--                                    <td><a href="{{ route('open-driver', ['driver' => $driver->id]) }}">{{ $driver->name }}</a></td>--}}
{{--                                </tr>--}}

{{--                        @endforeach--}}

{{--                @endforeach--}}

{{--                <tr>--}}
{{--                    <th class="reserves">Reserves</th>--}}
{{--                </tr>--}}

{{--                    @foreach($drivers->where('team_id', $teams->where('name', 'Reserves')->first()->id) as $driver)--}}

{{--                        <tr>--}}
{{--                            <td><a href="{{ route('open-driver', ['driver' => $driver->id]) }}">{{ $driver->name }}</a></td>--}}
{{--                        </tr>--}}

{{--                    @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}

    <div class="lineup-table-container">

        @foreach($teams as $team)

            @if($team->name == "Reserves" or $team->name == "None")
                @continue
            @endif

            <fieldset class="{{ strtolower(str_replace(' ', '', $team->name)) }}">

                <div class="team-name-container">
                    <p class="{{ strtolower(str_replace(' ', '', $team->name)) }}"><a href="{{ route('open-team', ['team' => $team->id]) }}">{{ $team->name }}</a></p>
                </div>

                <div class="team-icon-container">
                    <img src="{{ asset('resources/media/teamicons/' . strtolower(str_replace(' ', '', $team->name)) . ".png") }}" alt="">
                </div>

                <hr class="divider-line divider-line-1">

                <div class="team-drivers-container">
                    <ul>
                        @foreach($drivers->where('team_id', $team->id) as $driver)
                            <li class="{{ strtolower(str_replace(' ', '', $team->name)) }}">
                                <a href="{{ route('open-driver', ['driver' => $driver->id]) }}">{{ $driver->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <hr class="divider-line divider-line-2">

                <div class="team-car-container">
                    <img src="{{ asset('resources/media/cargraphics/' . strtolower(str_replace(' ', '', $team->name)) . ".png") }}" alt="">
                </div>

            </fieldset>
        @endforeach
    </div>

@endsection
