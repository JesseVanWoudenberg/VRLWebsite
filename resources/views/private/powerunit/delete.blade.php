@extends('layouts.private-layout')

@section('page-title') Power unit - Delete @endsection

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
            <form action="{{ route('powerunit.destroy', ['powerunit' => $powerunit->id]) }}" method="POST">

                @method('DELETE')
                @csrf

                <label for="name">Power unit name</label>
                <input @error('name') @enderror type="text" id="name" name='name' value="{{ $powerunit->name }}" disabled>

                <input type="submit" value="delete">
            </form>
        </div>
    </div>

@endsection
