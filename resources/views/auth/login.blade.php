@extends('layouts.auth-layout')

@section('page-title') Login @endsection

@section('page') login @endsection

@section('content')

    <div class="login-form-container">
        <form action="{{ route('login.custom') }}" method="post">

            @csrf
            @method('POST')

            <div class="email-container">
                <i class="fas fa-user"></i>
                <label for="name">Email</label>
                <input type="text" id="name" name="name" autocomplete="off">
            </div>

            <div class="password-container">
                <i class="fas fa-lock"></i>
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>

            <input type="submit" id="submit" value="login">
        </form>
    </div>

@endsection
