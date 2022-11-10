@extends('layouts.private-layout')

@section('page-title') Track - Delete @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Delete Track</h1>
            @endif
        </div>

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

@endsection
