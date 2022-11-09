@extends('layouts.private-layout')

@section('page-title') Power unit - Edit @endsection

@section('page') private-create-edit-delete @endsection

@section('content')


    <div class="form-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Create Article</h1>
            @endif
        </div>

        <form action="{{ route('powerunit.destroy', ['powerunit' => $powerunit->id]) }}" method="POST">

            @method('PUT')
            @csrf

            <label for="name">Power unit name</label>
            <input @error('name') @enderror type="text" id="name" name='name' value="{{ $powerunit->name }}">

            <input type="submit" value="edit">
        </form>
    </div>


@endsection
