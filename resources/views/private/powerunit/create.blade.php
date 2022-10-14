@extends('layouts.private-layout')

@section('page-title') Power unit - Create @endsection

@section('page') powerunit-create-edit-delete @endsection

@section('content')

    <div>
        @if ($errors->any())
            <div>
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('powerunit.store') }}" method="POST">
                @csrf

                <label for="name">Power unit name</label>
                <input @error('name') @enderror type="text" id="name" name='name' value="{{ old('name') }}">

                <input type="submit" value="Add power unit">
            </form>
        </div>
    </div>

@endsection
