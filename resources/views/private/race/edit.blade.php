@extends('layouts.private-layout')

@section('page-title') Race - Edit @endsection

@section('page') race-create-edit-delete @endsection

@section('content')

    <div class="race-create-container">

        <div class="table-header">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Edit Race</h1>
            @endif
        </div>

        <form action="{{ route('race.update', ['race' => $race->id]) }}" method="POST">

            @method('PUT')
            @csrf

            <div class="race-info-container">

                <label for="round">Round</label>
                <label for="track_id">Track</label>
                <label for="season_id">Season</label>
                <label for="raceformat_id">Race format</label>

                <input @error('name') @enderror type="number" id="round" name='round' value="{{ $race->round }}">

                <div class="select-container">
                    <select name="track_id" id="track_id">
                        @foreach($tracks as $track)
                            <option value="{{ $track->id }}" @if($track->id == $race->track_id) selected @endif>{{ $track->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="select-container">
                    <select name="season_id" id="season_id">
                        @foreach($seasons as $season)
                            <option value="{{ $season->id }}" @if($season->id == $race->season_id) selected @endif >{{ "Season: " . $season->seasonnumber . " - Tier: " . $season->tier->tiernumber }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="select-container">
                    <select name="raceformat_id" id="raceformat_id">
                        @foreach($raceformats as $raceformat)
                            <option value="{{ $raceformat->id }}" @if($raceformat->id == $race->raceformat_id) selected @endif >{{ $raceformat->format }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="date-picker">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" value="{{ $race->date }}" required>
            </div>

            <div class="race-results-container">

                @for($i = 1; $i < 21; $i++)
                    <div class="result-row">

                        <p>P{{$i}}</p>

                        <div class="select-container">
                            <select name="driver{{$i}}" id="driver{{$i}}">
                                <option value="none">None</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}" @if($racedrivers->where('driver_id', '=', $driver->id)->where('position', '=', $i)->count() > 0) @if($driver->id == $racedrivers->where('driver_id', $driver->id)->where('position', '=', $i)->first()->driver_id) selected @endif @endif>{{ $driver->name }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="select-container">
                            <select name="team{{$i}}" id="team{{$i}}">
                                <option value="none">None</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" @if($racedrivers->where('team_id', '=', $team->id)->where('position', '=', $i)->count() > 0) @if($team->id == $racedrivers->where('team_id', $team->id)->where('position', '=', $i)->first()->team_id) selected @endif @endif>{{ $team->name }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <input type="checkbox" name="dnf{{$i}}" value="dnf{{$i}}" @if($racedrivers->where('position', '=', $i)->where('dnf', '=', 1)->count() > 0) checked @endif>
                    </div>
                @endfor
            </div>

            <div class="fastest-lap-container">

                <p>Fastest lap</p>

                <table>
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th>Team</th>
                            <th>Lap time</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <div class="select-container">
                                    <select name="fastest-lap-driver" id="fastest-lap-driver">
                                        <option value="none">None</option>
                                            @foreach($drivers as $driver)
                                                <option value="{{ $driver->id }}" @if($fastestlap != null) @if($fastestlap->driver_id == $driver->id) selected @endif @endif>{{ $driver->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="select-container">
                                    <select name="fastest-lap-team" id="fastest-lap-team">
                                        <option value="none">None</option>
                                            @foreach($teams as $team)
                                                <option value="{{ $team->id }}" @if($fastestlap != null) @if($fastestlap->team_id == $team->id) selected @endif @endif>{{ $team->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <input type="number" step=".001" id="fastest-lap-time" name="fastest-lap-time" @if($fastestlap != null) value="{{ $fastestlap->laptime }}" @endif>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="race-buttons-container">
                <p id="qualifying-previous-button">Full Qualifying</p>
                <p id="qualifying-next-button">Short Qualifying</p>
            </div>

            <div class="full-qualifying-results-container qualifying-results">

                <p class="full-qualifying-title">Full Qualifying</p>

                <table>
                    <thead>
                        <tr>
                            <th>Driver</th>
                            <th>Team</th>
                            <th>Q1</th>
                            <th>Q1 Laptime</th>
                            <th>Q1 Tyre</th>
                            <th>Q2</th>
                            <th>Q2 Laptime</th>
                            <th>Q2 Tyre</th>
                            <th>Q3</th>
                            <th>Q3 Laptime</th>
                            <th>Q3 Tyre</th>
                        </tr>
                    </thead>

                    <tbody>
                        @for($i = 1; $i < 21; $i++)
                            <tr>
                                <td>
                                    <div class="select-container">
                                        <select name="full-driver-{{$i}}" id="full-driver-{{$i}}">
                                            <option value="none">None</option>
                                            @foreach($drivers as $driver)
                                                <option value="{{ $driver->id }}" @if($fullqualifyingdrivers->where('driver_id', '=', $driver->id)->where('q3', '=', $i)->count() > 0) selected @endif>{{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="select-container">
                                        <select name="full-team-{{$i}}" id="full-team-{{$i}}">
                                            <option value="none">None</option>
                                            @foreach($teams as $team)
                                                <option value="{{ $team->id }}" @if($fullqualifyingdrivers->where('team_id', '=', $team->id)->where('q3', '=', $i)->count() > 0) selected @endif>{{ $team->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="qualifying-select-container">
                                        <select name="full-Q1-{{$i}}" id="full-Q1-{{$i}}">
                                            <option value="100">out</option>
                                            @for($j = 1; $j < 21; $j++)
                                                <option value="{{$j}}" @if($fullqualifyingdrivers->where('q1', '=', $j)->count() > 0) selected @endif>{{$j}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" step=".001" id="full-q1-time-{{$i}}" name="full-q1-time-{{$i}}" @if($fullqualifyingdrivers->where('q3', '=', $i)->count() > 0) value="{{ $fullqualifyingdrivers->where('q3', '=', $i)->first()->q1laptime }}" @endif>
                                </td>
                                <td>
                                    <div class="tyre-select-container">
                                        <select name="full-q1tyre-{{$i}}">
                                            <option value="Soft" @if($fullqualifyingdrivers->where('q3', '=', $i)->where('q1tyre', '=', 'Soft')->count() > 0) selected @endif>Soft</option>
                                            <option value="Medium" @if($fullqualifyingdrivers->where('q3', '=', $i)->where('q1tyre', '=', 'Medium')->count() > 0) selected @endif>Medium</option>
                                            <option value="Intermediate" @if($fullqualifyingdrivers->where('q3', '=', $i)->where('q1tyre', '=', 'Intermediate')->count() > 0) selected @endif>Inter</option>
                                            <option value="Fullwet" @if($fullqualifyingdrivers->where('q3', '=', $i)->where('q1tyre', '=', 'Fullwet')->count() > 0) selected @endif>Wet</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="qualifying-select-container">
                                        <select name="full-Q2-{{$i}}" id="full-Q2-{{$i}}">
                                            <option value="100">out</option>
                                            @for($j = 1; $j < 21; $j++)
                                                <option value="{{$j}}" @if($fullqualifyingdrivers->where('q2', '=', $j)->count() > 0) selected @endif>{{$j}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" step=".001" id="full-q2-time-{{$i}}" name="full-q2-time-{{$i}}" @if($fullqualifyingdrivers->where('q3', '=', $i)->count() > 0) value="{{ $fullqualifyingdrivers->where('q3', '=', $i)->first()->q2laptime }}" @endif>
                                </td>
                                <td>
                                    <div class="tyre-select-container">
                                        <select name="full-q2tyre-{{$i}}">
                                            <option value="Soft" @if($fullqualifyingdrivers->where('q3', '=', $i)->where('q2tyre', '=', 'Soft')->count() > 0) selected @endif>Soft</option>
                                            <option value="Medium" @if($fullqualifyingdrivers->where('q3', '=', $i)->where('q2tyre', '=', 'Medium')->count() > 0) selected @endif>Medium</option>
                                            <option value="Intermediate" @if($fullqualifyingdrivers->where('q3', '=', $i)->where('q2tyre', '=', 'Intermediate')->count() > 0) selected @endif>Inter</option>
                                            <option value="Fullwet" @if($fullqualifyingdrivers->where('q3', '=', $i)->where('q2tyre', '=', 'Fullwet')->count() > 0) selected @endif>Wet</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="qualifying-select-container">
                                        <select name="full-Q3-{{$i}}" id="full-Q3-{{$i}}">
                                            @if($i < 11)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @else
                                                <option value="100">out</option>
                                            @endif
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" step=".001" id="full-q3-time-{{$i}}" name="full-q3-time-{{$i}}" @if($fullqualifyingdrivers->where('q3', '=', $i)->count() > 0) value="{{ $fullqualifyingdrivers->where('q3', '=', $i)->first()->q3laptime }}" @endif>
                                </td>
                                <td>
                                    <div class="tyre-select-container">
                                        <select name="full-q3tyre-{{$i}}">
                                            <option value="Soft" @if($fullqualifyingdrivers->where('q3', '=', $i)->where('q3tyre', '=', 'Soft')->count() > 0) selected @endif>Soft</option>
                                            <option value="Medium" @if($fullqualifyingdrivers->where('q3', '=', $i)->where('q3tyre', '=', 'Medium')->count() > 0) selected @endif>Medium</option>
                                            <option value="Intermediate" @if($fullqualifyingdrivers->where('q3', '=', $i)->where('q3tyre', '=', 'Intermediate')->count() > 0) selected @endif>Inter</option>
                                            <option value="Fullwet" @if($fullqualifyingdrivers->where('q3', '=', $i)->where('q3tyre', '=', 'Fullwet')->count() > 0) selected @endif>Wet</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <div class="short-qualifying-results-container qualifying-results">

                <p class="short-qualifying-title">Short Qualifying</p>

                <table>
                    <thead>
                        <tr>
                            <th>Qualifying Position</th>
                            <th>Laptime </th>
                            <th>Driver</th>
                            <th>Team</th>
                            <th>Tyre used</th>
                        </tr>
                    </thead>

                    <tbody>
                        @for($i = 1; $i < 21; $i++)

                            <tr>

                                <td>{{ $i }}</td>

                                <td>
                                    <input type="number" step=".001" id="short-laptime-{{$i}}" name='short-laptime-{{$i}}' @if($shortqualifyingdrivers->where('position', '=', $i)->count() > 0) value="{{ $shortqualifyingdrivers->where('position', '=', $i)->first()->laptime }}" @endif>
                                </td>

                                <td>
                                    <div class="select-container">
                                        <select name="short-driver-{{$i}}" id="short-driver-{{$i}}">
                                            <option value="none">None</option>
                                            @foreach($drivers as $driver)
                                                <option value="{{ $driver->id }}" @if($shortqualifyingdrivers->where('driver_id', '=', $driver->id)->where('position', '=', $i)->count() > 0) selected @endif>{{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="select-container">
                                        <select name="short-team-{{$i}}" id="short-team-{{$i}}">
                                            <option value="none">None</option>
                                            @foreach($teams as $team)
                                                <option value="{{ $team->id }}" @if($shortqualifyingdrivers->where('team_id', '=', $team->id)->where('position', '=', $i)->count() > 0) selected @endif>{{ $team->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="select-container">
                                        <select name="short-tyre-{{$i}}" id="short-tyre-{{$i}}">
                                            <option value="Soft" @if($shortqualifyingdrivers->where('position', '=', $i)->where('tyre', '=', 'Soft')->count() > 0) selected @endif>Soft</option>
                                            <option value="Medium" @if($shortqualifyingdrivers->where('position', '=', $i)->where('tyre', '=', 'Medium')->count() > 0) selected @endif>Medium</option>
                                            <option value="Intermediate" @if($shortqualifyingdrivers->where('position', '=', $i)->where('tyre', '=', 'Intermediate')->count() > 0) selected @endif>Inter</option>
                                            <option value="Fullwet" @if($shortqualifyingdrivers->where('position', '=', $i)->where('tyre', '=', 'Fullwet')->count() > 0) selected @endif>Wet</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <input type="submit" value="Edit">
        </form>
    </div>

    <script src="{{ asset('resources/javascript/qualifying-carousel.js') }}"></script>

@endsection
