@extends('layouts.driver-layout')

@section('page-title') Driver - Requests @endsection

@section('page') driver-request-create @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Driver number change request</h1>
            @endif
        </div>

        <form action="{{ route('driver.requests.drivernumber.store') }}" method="POST">
            
            @csrf

            <label for="newnumber">New Number</label>
            <input @error('newnumber') @enderror type="text" id="newnumber" name='newnumber' value="{{ old('newnumber') }}">

            <input type="submit" value="Send Request">
        </form>
    </div>

@endsection
