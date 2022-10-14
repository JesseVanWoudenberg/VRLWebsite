@extends('layouts.private-layout')

@section('page-title') Season - Edit @endsection

@section('page') season-create-edit-delete @endsection

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
            <form action="{{ route('season.update', ['season' => $season->id]) }}" method="POST">

                @method('PUT')
                @csrf

                <label for="seasonnumber">Season Number</label>
                <input @error('name') @enderror type="number" id="seasonnumber" name='seasonnumber' value="{{ $season->seasonnumber }}">

                <label for="tier_id">Tier Number</label>
                <div class="select-container">
                    <select name="tier_id" id="tier_id">
                        @foreach($tiers as $tier)
                            <option value="{{ $tier->id }}" @if($season->tier->id == $tier->id) selected @endif>{{ $tier->tiernumber }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="submit" value="edit">
            </form>
        </div>
    </div>

@endsection
