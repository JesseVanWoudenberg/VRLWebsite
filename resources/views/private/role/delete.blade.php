@extends('layouts.private-layout')

@section('page-title') Role - Edit @endsection

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

        <form action="{{ route('role.update', ['role' => $role->id]) }}" method="POST">

            @method('DELETE')
            @csrf

            <label for="name">Name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ $role->name }}" disabled>

            <input type="submit" value="Delete">
        </form>
    </div>

@endsection
