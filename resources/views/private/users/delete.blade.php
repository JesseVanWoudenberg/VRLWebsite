@extends('layouts.private-layout')

@section('page-title') User - Delete @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Delete User</h1>
            @endif
        </div>

        <form action="{{ route('user.destroy') }}" method="POST">

            @method('DELETE')
            @csrf

            <label for="name">Name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ $user->name }}">

            <label for="email">Email</label>
            <input @error('email') @enderror type="email" id="email" name='email' value="{{ $user->email }}">

            <input type="submit" value="Add">
        </form>
    </div>

@endsection
