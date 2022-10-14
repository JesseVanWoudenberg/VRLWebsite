@extends('layouts.private-layout')

@section('page-title') Race - Delete @endsection

@section('page') race-create-edit-delete @endsection

@section('content')

    <div>
        @if ($errors->any())
            <div>
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('race.destroy', ['race' => $race->id]) }}" method="POST">

                @method('DELETE')
                @csrf

                <label for="round">Round</label>
                <input @error('name') @enderror type="number" id="round" name='round' value="{{ $race->round }}" disabled>

                <label for="track_id">Track</label>
                <div class="select-container">
                    <select name="track_id" id="track_id">
                        @foreach($tracks as $track)
                            <option value="{{ $track->id }}" @if($track->id == $race->track_id) selected @endif disabled>{{ $track->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="season_id">Season</label>
                <div class="select-container">
                    <select name="season_id" id="season_id">
                        @foreach($seasons as $season)
                            <option value="{{ $season->id }}" @if($season->id == $race->season_id) selected @endif disabled >{{ "Season: " . $season->seasonnumber . " - Tier: " . $season->tier->tiernumber }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="fldriver_id">Fastest Lap</label>
                <div class="select-container">
                    <select name="fldriver_id" id="fldriver_id">
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" @if($driver->id == $fastestlaps->firstWhere('race_id', $race->id)->driver_id) selected @endif disabled>{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="fltime">Time</label>
                <input @error('name') @enderror type="number" step=".001" id="fltime" name='fltime' value="{{ $fastestlaps->firstWhere('race_id', $race->id)->laptime  }}" disabled>

                <label for="raceformat_id">Race Format</label>
                <div class="select-container">
                    <select name="raceformat_id" id="raceformat_id">
                        @foreach($raceformats as $raceformat)
                            <option value="{{ $raceformat->id }}" @if($raceformat->id == $race->raceformat_id) selected @endif disabled>{{ $raceformat->format }}</option>
                        @endforeach
                    </select>
                </div>

                @for($i = 1; $i <= 20; $i++)

                    <div class="result-line-container">
                        <label for="p{{$i}}">P{{$i}}</label>
                        <label for="dnf{{$i}}">DNF</label>

                        <label for="qualifying1-p{{$i}}">Q1</label>
                        <label for="qualifying1-time{{$i}}">Q1 Time</label>

                        <label for="qualifying2-p{{$i}}">Q2</label>
                        <label for="qualifying2-time{{$i}}">Q2 Time</label>

                        <label for="qualifying3-p{{$i}}">Q3</label>
                        <label for="qualifying3-time{{$i}}">Q3 Time</label>

                        <div class="select-container driver-input">
                            <select name="driver{{$i}}" id="p{{$i}}">
                                <option value="none">None</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="dnf-container">
                            <input type="checkbox" id="dnf{{$i}}" name="dnf{{$i}}">
                        </div>

                        <div class="qualifying-container">
                            <div class="select-container qualifying-input">
                                <select name="qualifying1-driver{{$i}}" id="qualifying1-p{{$i}}">
                                    @for($j = 1; $j <= 20; $j++)
                                        <option value="{{$j}}" @if($race_drivers->contains('position', $i)) @if($race_drivers->firstWhere('position', $i)->q1 == $j) selected @endif @endif>{{$j}}</option>
                                    @endfor
                                    <option value="100">DNF</option>
                                </select>
                            </div>

                            <input type="text" @if($race_drivers->contains('position', $i)) value="{{ $race_drivers->firstWhere('position', $i)->q1laptime }}" @endif name="qualifying1-time{{$i}}" id="qualifying1-time{{$i}}">
                        </div>

                        <div class="qualifying-container">
                            <div class="select-container qualifying-input">
                                <select name="qualifying2-driver{{$i}}" id="qualifying2-p{{$i}}">
                                    @for($j = 1; $j <= 20; $j++)
                                        <option value="{{$j}}" @if($race_drivers->contains('position', $i)) @if($race_drivers->firstWhere('position', $i)->q2 == $j) selected @endif @endif>{{$j}}</option>
                                    @endfor
                                    <option value="100">DNF</option>
                                </select>
                            </div>

                            <input type="text" @if($race_drivers->contains('position', $i)) value="{{ $race_drivers->firstWhere('position', $i)->q2laptime }}" @endif name="qualifying2-time{{$i}}" id="qualifying2-time{{$i}}">
                        </div>

                        <div class="qualifying-container">
                            <div class="select-container qualifying-input">
                                <select name="qualifying3-driver{{$i}}" id="qualifying3-p{{$i}}">
                                    @for($j = 1; $j <= 20; $j++)
                                        <option value="{{$j}}" @if($race_drivers->contains('position', $i)) @if($race_drivers->firstWhere('position', $i)->q3 == $j) selected @endif @endif>{{$j}}</option>
                                    @endfor
                                    <option value="100">DNF</option>
                                </select>
                            </div>

                            <input type="text" @if($race_drivers->contains('position', $i)) value="{{ $race_drivers->firstWhere('position', $i)->q3laptime }}" @endif name="qualifying3-time{{$i}}" id="qualifying3-time{{$i}}">
                        </div>
                    </div>
                @endfor

                <input type="submit" value="Remove">
            </form>
        </div>
    </div>

@endsection
