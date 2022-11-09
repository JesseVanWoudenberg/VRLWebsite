@extends('layouts.private-layout')

@section('page-title') Team - Create @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Create Team</h1>
            @endif
        </div>

        <form action="{{ route('team.store') }}" method="POST">
            @csrf

            <label for="name">Team name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ old('name') }}">

            <label for="powerunit_id">Power unit</label>
            <div class="select-container">
                <select name="powerunit_id" id="powerunit_id">
                    @foreach($powerunits as $powerunit)
                        <option value="{{ $powerunit->id }}">{{ $powerunit->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Add team">
        </form>
    </div>

@endsection
