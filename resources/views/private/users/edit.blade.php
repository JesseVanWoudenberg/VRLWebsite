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

        <form action="{{ route('user.update') }}" method="POST">

            @method('PUT')
            @csrf

            <label for="name">Name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ $user->name }}">

            <label for="email">Email</label>
            <input @error('email') @enderror type="email" id="email" name='email' value="{{ $user->email }}">

            <label for="password">New password</label>
            <input @error('password') @enderror type="password" id="password" name='password'>

            <input type="submit" value="Edit">
        </form>
    </div>

@endsection
