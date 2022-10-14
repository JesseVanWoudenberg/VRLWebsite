@extends('layouts.auth-layout')

@section('page-title') Register @endsection

@section('page') register @endsection

@section('content')

    <div class="register-container">
        <form action="{{ route('register.custom') }}" method="POST">

            @csrf

            <div class="username-container">
                <label for="name">Username</label>
                <input type="text" id="name" name="name" required>

                @if ($errors->has('name'))
                    <span>{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="email-container">
                <label for="email_address">Email</label>
                <input type="text" id="email_address" name="email" required>

                @if ($errors->has('email'))
                    <span>{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="password-container">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                @if ($errors->has('password'))
                    <span>{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="button-container">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>

@endsection
