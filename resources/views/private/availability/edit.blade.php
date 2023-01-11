@php use App\Models\Availability\AvailabilityType;use App\Models\Availability\DriverAvailability;use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.private-layout')

@section('page-title')
    Admin - Availability
@endsection

@section('page')
    availability-edit
@endsection

@section('content')

    <div class="availability-edit-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Availability - Round: {{ $raceAvailability->race->round }}</h1>
            @endif
        </div>

        <div class="availability-edit-form-container">


            <form action="{{ route('admin.availability.update', ['raceAvailabilityId' => $raceAvailability->id, 'driverId' => $driver->id]) }}" method="GET">

                @method('PUT')
                @csrf

                <div class="availability-options">

                    <div class="option-container">
                        <label for="Accepted">Accept</label>
                        <input type="radio" name="availability-type" id="Accepted" value="Accepted" required
                               @if(DriverAvailability::all()
                                                      ->where('race_availability_id', '=', $raceAvailability->id)
                                                    ->where('availability_type_id', '=', AvailabilityType::all()
                                                    ->where('name', '=', 'Accepted')->first()->id)
                                                    ->where('driver_id', '=', Auth::user()->driver->id)
                                                    ->count() > 0)
                                   checked
                            @endif>
                    </div>

                    <div class="option-container">
                        <label for="Declined">Decline</label>
                        <input type="radio" name="availability-type" id="Declined" value="Declined"
                               @if(DriverAvailability::all()
                                                      ->where('race_availability_id', '=', $raceAvailability->id)
                                                      ->where('availability_type_id', '=', AvailabilityType::all()
                                                      ->where('name', '=', 'Declined')->first()->id)
                                                      ->where('driver_id', '=', Auth::user()->driver->id)
                                                      ->count() > 0)
                                   checked
                            @endif>
                    </div>

                    <div class="option-container">
                        <label for="Tentative">Tentative</label>
                        <input type="radio" name="availability-type" id="Tentative" value="Tentative"
                               @if(DriverAvailability::all()
                                                      ->where('race_availability_id', '=', $raceAvailability->id)
                                                      ->where('availability_type_id', '=', AvailabilityType::all()
                                                      ->where('name', '=', 'Tentative')->first()->id)
                                                      ->where('driver_id', '=', Auth::user()->driver->id)
                                                      ->count() > 0)
                                   checked
                            @endif>
                    </div>
                </div>

                <input type="submit" value="Update Availability">
            </form>
        </div>
    </div>

@endsection
