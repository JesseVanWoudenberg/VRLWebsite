@extends('layouts.public-layout')

@section('page-title') Profile @endsection

@section('page') profile-edit @endsection

@section('content')

    <div class="profile-edit-container">
        @if ($errors->any())
            <div>
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form class="mt-2" action="{{ route('profile.update', ['profile' => $user->id]) }}" method="POST">
            @method('PUT')
            @csrf

            <p>leave password field open if you don't want to change it</p>

            <label for="name">Name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ $user->name }}" autocomplete="off">

            <label for="email">Email</label>
            <input @error('email') @enderror type="text" id="email" name='email' value="{{ $user->email }}" autocomplete="off">

            <label for="password">Password</label>
            <input @error('password') @enderror type="password" id="password" name='password' autocomplete="off">

            <input type="submit" value="edit">
        </form>
    </div>

@endsection
