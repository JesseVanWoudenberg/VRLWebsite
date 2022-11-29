@extends('layouts.private-layout')

@section('page-title') Permission - Create @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Create Permission</h1>
            @endif
        </div>

        <form action="{{ route('permission.store') }}" method="POST">

            @csrf

            <label for="name">Name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ old('name') }}" autocomplete="off">

            <input type="submit" value="Add">
        </form>
    </div>

@endsection
