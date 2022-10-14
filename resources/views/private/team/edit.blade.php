@extends('layouts.private-layout')

@section('page-title') Track - Edit @endsection

@section('page') team-create-edit-delete @endsection

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
    </div>

@endsection
