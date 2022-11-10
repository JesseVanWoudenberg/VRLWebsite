@extends('layouts.private-layout')

@section('page-title') Season - Create @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Create Season</h1>
            @endif
        </div>

        <form action="{{ route('season.store') }}" method="POST">
            @csrf

            <label for="seasonnumber">Season Number</label>
            <input @error('name') @enderror type="number" id="seasonnumber" name='seasonnumber' value="{{ old('seasonnumber') }}">

            <label for="tier_id">Tier Number</label>
            <div class="select-container">
                <select name="tier_id" id="tier_id">
                    @foreach($tiers as $tier)
                        <option value="{{ $tier->id }}">{{ $tier->tiernumber }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Add Season">
        </form>
    </div>


@endsection
