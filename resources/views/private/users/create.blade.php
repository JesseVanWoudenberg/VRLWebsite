@extends('layouts.private-layout')

@section('page-title') User - Create @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Create User</h1>
            @endif
        </div>

        <form action="{{ route('user.store') }}" method="POST">

            @csrf

            <label for="name">Name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ old('name') }}" autocomplete="off" required>

            <label for="email">Email</label>
            <input @error('email') @enderror type="email" id="email" name='email' value="{{ old('email') }}" autocomplete="off">

            <label for="password">Password</label>
            <input @error('password') @enderror type="password" id="password" name='password' value="{{ old('password') }}" autocomplete="off" required>

            <label for="driver_id">Optional Linked Driver ID</label>
            <div class="select-container">
                <select name="driver_id" id="driver_id">
                    <option value="none" selected>None</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Add">
        </form>
    </div>

@endsection
