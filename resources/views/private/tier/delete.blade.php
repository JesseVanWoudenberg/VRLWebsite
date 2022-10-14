@extends('layouts.private-layout')

@section('page-title') Tier - Delete @endsection

@section('page') tier-create-delete @endsection

@section('content')

    <div class="form-container">
        <form action="{{ route('tier.destroy', ['tier' => $tier->id]) }}" method="POST">
            @method('DELETE')
            @csrf

            <label for="tiernumber">Tiernumber</label>
            <input @error('name') @enderror type="number" id="tiernumber" name='tiernumber' value="{{ $tier->tiernumber }}" disabled>

            <input type="submit" value="delete">
        </form>
    </div>

@endsection
