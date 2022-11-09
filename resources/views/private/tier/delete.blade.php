@extends('layouts.private-layout')

@section('page-title') Tier - Delete @endsection

@section('page') private-create-edit-delete @endsection

@section('content')

    <div class="form-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Delete Tier</h1>
            @endif
        </div>

        <form action="{{ route('tier.destroy', ['tier' => $tier->id]) }}" method="POST">
            @method('DELETE')
            @csrf

            <label for="tiernumber">Tiernumber</label>
            <input @error('name') @enderror type="number" id="tiernumber" name='tiernumber' value="{{ $tier->tiernumber }}" disabled>

            <input type="submit" value="delete">
        </form>
    </div>

@endsection
