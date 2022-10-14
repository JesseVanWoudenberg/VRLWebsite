@extends('layouts.private-layout')

@section('page-title') Register @endsection

@section('page') register @endsection

@section('content')

    <div>
        <form action="{{ route('register') }}" method="post">

            @csrf
            @method('POST')

            <label for="email">email</label>
            <input type="email" id="email" name="email">

            <label for="name">name</label>
            <input type="text" id="name" name="name">

            <label for="password">password</label>
            <input type="password" id="password" name="password">

            <input type="submit" value="login">
        </form>
    </div>

@endsection
