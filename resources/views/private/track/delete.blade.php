@extends('layouts.private-layout')

@section('page-title') Track - Delete @endsection

@section('page') track-create-edit-delete @endsection

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
            <form action="{{ route('track.destroy', ['track' => $track->id]) }}" method="POST">

                @method('DELETE')
                @csrf

                <label for="name">Track name</label>
                <input @error('name') @enderror type="text" id="name" name='name' value="{{ $track->name }}" disabled>

                <label for="country">Country</label>
                <input @error('name') @enderror type="text" id="country" name='country' value="{{ $track->country }}" disabled>

                <label for="length">Length</label>
                <input @error('name') @enderror type="number" step=".001" id="length" name='length' value="{{ $track->length }}" disabled>

                <label for="turns">Turns amount</label>
                <input @error('name') @enderror type="number" id="turns" name='turns' value="{{ $track->turns }}" disabled>

                <input type="submit" value="delete">
            </form>
        </div>
    </div>

@endsection
