@extends('layouts.private-layout')

@section('page-title') Track - Edit @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Edit Team</h1>
            @endif
        </div>

        <form action="{{ route('team.update', ['team' => $team->id]) }}" method="POST">

            @method('DELETE')
            @csrf

            <label for="name">Team name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ $team->name }}" disabled>

            <label for="powerunit_id">Power unit</label>
            <input @error('name') @enderror type="text" id="powerunit_id" name='powerunit_id' value="{{ $team->powerunit->name }}" disabled>

            <input type="submit" value="delete">
        </form>
    </div>

@endsection
