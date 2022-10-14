@extends('layouts.private-layout')

@section('page-title') Season - Delete @endsection

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

                @method('DELETE')
                @csrf

                <label for="seasonnumber">Season Number</label>
                <input @error('name') @enderror type="number" id="seasonnumber" name='seasonnumber' value="{{ $season->seasonnumber }}" disabled>

                <label for="tier_id">Tier Number</label>
                <div class="select-container">
                    <select name="tier_id" id="tier_id">
                        @foreach($tiers as $tier)
                            <option value="{{ $tier->id }}" @if($season->tier->id == $tier->id) selected @endif disabled>{{ $tier->tiernumber }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="submit" value="delete">
            </form>
        </div>
    </div>

@endsection
