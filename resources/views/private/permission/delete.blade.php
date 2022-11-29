@extends('layouts.private-layout')

@section('page-title') Permission - Delete @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Delete Permission</h1>
            @endif
        </div>

        <form action="{{ route('permission.destroy', ['permission' => $permission->id]) }}" method="POST">

            @method('DELETE')
            @csrf

            <label for="name">Name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ $permission->name }}" disabled autocomplete="off">

            <input type="submit" value="Delete">
        </form>
    </div>

@endsection
