@extends('layouts.private-layout')

@section('page-title') User - Edit @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Edit Driver</h1>
            @endif
        </div>

        <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">

            @method('PUT')
            @csrf

            <label for="name">Name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ $user->name }}" autocomplete="off">

            <label for="email">Email</label>
            <input @error('email') @enderror type="email" id="email" name='email' value="{{ $user->email }}" autocomplete="off">

            <label for="password">Password, leave empty to keep old password</label>
            <input @error('password') @enderror type="password" id="password" name='password' autocomplete="off">

            <label for="driver_id">Optional Linked Driver ID</label>
            <div class="select-container">
                <select name="driver_id" id="driver_id">
                    <option value="none" @if($user->driver_id == null) selected @endif>None</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" @if($driver->id == $user->driver_id) selected @endif>{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Edit">
        </form>
    </div>

@endsection
