@extends('layouts.driver-layout')

@section('page-title') Driver - Requests @endsection

@section('page') driver-request-index @endsection

@section('content')

    <div class="drivernumber-requests-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Driver number change requests</h1>
            @endif
        </div>

        <table>
            <thead>
                <tr>
                    <th>Status</th>
                    <th>New driver number</th>
                    <th>Submitted at</th>
                    <th>Last change at</th>
                </tr>
            </thead>

            <tbody>
                @foreach($drivernumberChangeRequests as $drivernumberChangeRequest)

                    <tr>
                        <td>{{ $drivernumberChangeRequest->requeststatus->status }}</td>
                        <td>{{ $drivernumberChangeRequest->new_drivernumber }}</td>
                        <td class="timestamp">{{ $drivernumberChangeRequest->created_at }}</td>
                        <td class="timestamp">{{ $drivernumberChangeRequest->updated_at }}</td>

                        <td class="delete-button">
                            <a href="{{ route('driverpanel.requests.drivernumber.delete', ['id' => $drivernumberChangeRequest->id]) }}">
                                <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">
                                Delete
                            </a>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    <div class="team-transfer-requests-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Driver team transfer request</h1>
            @endif
        </div>

        <table>
            <thead>
                <tr>
                    <th>Status</th>
                    <th>New team</th>
                    <th>Submitted at</th>
                    <th>Last change at</th>
                </tr>
            </thead>

            <tbody>
                @foreach($teamTransferChangeRequests as $teamTransferChangeRequest)

                    <tr>
                        <td>{{ $teamTransferChangeRequest->requeststatus->status }}</td>
                        <td>{{ $teamTransferChangeRequest->team->name }}</td>
                        <td class="timestamp">{{ $teamTransferChangeRequest->created_at }}</td>
                        <td class="timestamp">{{ $teamTransferChangeRequest->updated_at }}</td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>

@endsection
