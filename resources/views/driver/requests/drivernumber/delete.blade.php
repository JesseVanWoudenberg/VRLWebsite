@extends('layouts.confirm-layout')

@section('page-title') Confirm @endsection

@section('content')

    <div class="request-confirmation">

        <ul>
            <li>
{{--                <a href="{{ route('driverpanel.requests.drivernumber.destroy', ['id' => $drivernumberChangeRequestId]) }}">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">--}}
{{--                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>--}}
{{--                    </svg>--}}

{{--                    <span>Confirm</span>--}}
{{--                </a>--}}

{{--                <a href="{{ route('driverpanel') }}">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">--}}
{{--                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>--}}
{{--                    </svg>--}}

{{--                    <span>Back</span>--}}
{{--                </a>--}}

{{--                <form action="{{ route('driverpanel.requests.drivernumber.destroy', ['id' => $drivernumberChangeRequest->id]) }}" method="POST">--}}

{{--                    @method('DELETE')--}}
{{--                    @csrf--}}

{{--                    <input type="submit" value="delete">--}}
{{--                </form>--}}

                <a href="{{ route('driverpanel.requests.drivernumber.destroy', ['id' => $drivernumberChangeRequest->id]) }}">
                    <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">
                    Delete
                </a>

            </li>
        </ul>
    </div>

@endsection
