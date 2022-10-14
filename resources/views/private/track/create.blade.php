@extends('layouts.private-layout')

@section('page-title') Track - Create @endsection

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
            <form action="{{ route('track.store') }}" method="POST">

                @csrf

                <label for="name">Track name</label>
                <input @error('name') @enderror type="text" id="name" name='name' value="{{ old('name') }}">

                <label for="country">Country</label>
                <input @error('name') @enderror type="text" id="country" name='country' value="{{ old('country') }}">


                <label for="length">Length</label>
                <input @error('name') @enderror type="number" step=".001" id="length" name='length' value="{{ old('length') }}">

                <label for="turns">Turns amount</label>
                <input @error('name') @enderror type="number" id="turns" name='turns' value="{{ old('turns') }}">

                <input type="submit" value="Add track">
            </form>
        </div>
    </div>

@endsection
