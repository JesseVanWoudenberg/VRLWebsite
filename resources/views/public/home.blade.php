@php use App\Models\Race; use App\Models\Tier; use Carbon\Carbon @endphp
@extends('layouts.public-layout')

@section('page-title')
    Home
@endsection

@section('page')
    homepage
@endsection

@section('content')

    <div class="races-container">

        <div class="title">
            <h1>Upcoming Races</h1>
        </div>

        @foreach(Tier::all() as $tier)

            @php $race = Race::all()->where('tier_id', '=', $tier->id)->where('date', '>=', Carbon::now()->format('Y-m-d'))->first() @endphp

            <div class="next-race-container">

                <fieldset>

                    <legend>Tier: {{ $race->tier->tiernumber }} | Round {{ $race->round }}</legend>

                    <div class="date">
                        <p>
                            {{ Carbon::make($race->date)->format("jS") }}
                        </p>
                    </div>

                    <div class="month">
                        <p>
                            {{ Carbon::make($race->date)->getTranslatedMonthName() }}
                        </p>
                    </div>

                    <div class="country">
                        <p>
                            {{ $race->track->country }} - <em>{{ ucfirst($race->raceformat->format) }}</em>
                        </p>
                    </div>

                    <div class="flag">
                        <img
                            src="{{ asset('resources/media/flags/' .  strtolower(str_replace(" ", "", $race->track->country )) . "-flag.jpg") }}"
                            alt="Flag"
                        >
                    </div>

{{--                    <hr class="divider-line divider-line-1">--}}

                    <div class="track-map">
                        <div>
                            <a href="{{ route('open-track', ['track' => $race->track->id]) }}">
                                <img
                                    src="{{ asset('resources/media/trackmaps/' . strtolower(str_replace(" ", "-", $race->track->name)) . ".png") }}"
                                    alt="Track map"
                                >
                            </a>
                        </div>
                    </div>

                </fieldset>
            </div>
        @endforeach
    </div>

@endsection
