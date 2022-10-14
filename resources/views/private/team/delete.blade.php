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

                @method('DELETE')
                @csrf

                <label for="name">Team name</label>
                <input @error('name') @enderror type="text" id="name" name='name' value="{{ $team->name }}" disabled>

                <label for="powerunit_id">Power unit</label>
                <input @error('name') @enderror type="text" id="powerunit_id" name='powerunit_id' value="{{ $team->powerunit->name }}" disabled>

                <input type="submit" value="delete">
            </form>
        </div>
    </div>

@endsection
