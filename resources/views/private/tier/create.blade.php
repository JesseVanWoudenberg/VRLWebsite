@extends('layouts.private-layout')

@section('page-title') Tier - Create @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Create Tier</h1>
            @endif
        </div>

        <form action="{{ route('tier.store') }}" method="POST">
            @csrf

            <label for="tiernumber">Tiernumber</label>
            <input @error('name') @enderror type="number" id="tiernumber" name='tiernumber' value="{{ old('tiernumber') }}">

            <input type="submit" value="Add Tier">
        </form>
    </div>

@endsection
