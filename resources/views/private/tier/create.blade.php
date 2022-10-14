@extends('layouts.private-layout')

@section('page-title') Tier - Create @endsection

@section('page') tier-create-delete @endsection

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
            <form action="{{ route('tier.store') }}" method="POST">
                @csrf

                <label for="tiernumber">Tiernumber</label>
                <input @error('name') @enderror type="number" id="tiernumber" name='tiernumber' value="{{ old('tiernumber') }}">

                <input type="submit" value="Add Tier">
            </form>
        </div>
    </div>

@endsection
