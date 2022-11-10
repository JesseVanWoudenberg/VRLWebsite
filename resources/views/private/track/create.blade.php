@extends('layouts.private-layout')

@section('page-title') Track - Create @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Create Track</h1>
            @endif
        </div>

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

@endsection
