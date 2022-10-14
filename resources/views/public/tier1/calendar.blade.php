@extends('layouts.public-layout')

@section('page-title') Tier 1 - Calendar @endsection

@section('page') race-calendar @endsection

@section('content')

    <div class="buttons-container">
        <button class="button" id="calendar-season-previous-button">Previous</button>
        <button class="button" id="calendar-season-next-button">Next</button>

        <h1 id="season-title"></h1>
    </div>


    @foreach($raceseasons as $raceseason)

        <div class="calendar-seasons-container">

            @foreach($raceseason as $race)

                <fieldset @if($race->done) class="finished" @endif>
                    <legend>Round {{ $race->round }}</legend>

                    <div class="date">
                        <p>
                            {{ \Carbon\Carbon::make($race->date)->format("d") }}
                        </p>
                    </div>

                    <div class="month">
                        <p>
                            {{ \Carbon\Carbon::make($race->date)->getTranslatedMonthName() }}
                        </p>
                    </div>

                    <div class="country">
                        <p>
                            {{ $race->track->country }} - <em>{{ ucfirst($race->raceformat->format) }}</em>
                        </p>
                    </div>

                    <div class="flag">
                        <img src="{{ asset('resources/media/flags/' .  strtolower(str_replace(" ", "", $race->track->country )) . "-flag.jpg") }}" alt="">
                    </div>

                    <hr class="divider-line divider-line-1">

                    @if($race->done)

                        <div class="race-results-link-container">
                            <a href="{{ route('open-race', ['race' => $race->id]) }}">Results</a>
                        </div>

                        <hr class="divider-line divider-line-2">
                    @endif

                    <div class="track-map">
                        <div>
                            <a href="{{ route('open-track', ['track' => $race->track->id]) }}">
                                <img src="{{ asset('resources/media/trackimages/' . strtolower(str_replace(" ", "-", $race->track->name)) . ".png") }}" alt="">
                            </a>
                        </div>
                    </div>

                </fieldset>

            @endforeach

{{--            <div class="race-calendar-container">--}}

{{--                <h1>Season {{ $loop->index + 1 }}</h1>--}}

{{--                <table>--}}
{{--                    <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Round</th>--}}
{{--                            <th>Race Format</th>--}}
{{--                            <th>Track</th>--}}
{{--                            <th>Country</th>--}}
{{--                        </tr>--}}
{{--                    </thead>--}}

{{--                    <tbody>--}}
{{--                        @foreach($raceseason as $race)--}}

{{--                            <tr>--}}
{{--                                <td>{{ $race->round }}</td>--}}
{{--                                <td>{{ $race->raceformat->format }}</td>--}}
{{--                                <td>{{ $race->track->name }}</td>--}}
{{--                                <td>--}}
{{--                                    <div class="flag-container">--}}
{{--                                        <img src="{{ asset('resources/media/flags/' .  strtolower(str_replace(" ", "", $race->track->country )) . "-flag.jpg") }}" alt="">--}}

{{--                                        <p>{{ $race->track->country }}</p>--}}
{{--                                    </div>--}}

{{--                                </td>--}}

{{--                                @if($race->done)--}}
{{--                                    <td><a href="{{ route('open-race', ['race' => $race->id]) }}">Results</a></td>--}}
{{--                                @else--}}
{{--                                    <td>No Results yet</td>--}}
{{--                                @endif--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}


        </div>
    @endforeach

    <script src="{{ asset('resources/javascript/calendar-carousel.js') }}"></script>

@endsection
