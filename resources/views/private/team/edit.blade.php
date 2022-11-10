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

            @method('PUT')
            @csrf

            <label for="name">Team name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ $team->name }}">

            <label for="powerunit_id">Power unit</label>
            <div class="select-container">
                <select name="powerunit_id" id="powerunit_id">
                    @foreach($powerunits as $powerunit)
                        <option value="{{ $powerunit->id }}" @if($powerunit->id == $team->powerunit->id) selected @endif>{{ $powerunit->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="edit">
        </form>
    </div>

@endsection
