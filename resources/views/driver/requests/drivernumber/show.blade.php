@php use App\Models\Requests\DrivernumberChangeRequestDenyReason; @endphp
@extends('layouts.driver-layout')

@section('page-title')
    Driver - Requests
@endsection

@section('page')
    driver-request-show
@endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show deny reason</h1>

        </div>

        <div class="show-content">

            <h1>Reason</h1>
            <p>{{ DrivernumberChangeRequestDenyReason::all()->where('drivernumber_change_request_id', '=', $drivernumberChangeRequest->id)->first()->reason }}</p>

        </div>
    </div>

@endsection
