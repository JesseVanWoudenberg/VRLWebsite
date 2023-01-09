@extends('layouts.private-layout')

@section('page-title')
    Request - Index
@endsection

@section('page')
    private-requests-index
@endsection

@section('content')

    <div class="index-list-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Drivernumber change requests - {{ $drivernumberChangeRequests->count() }}</h1>
            @endif

        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Driver</th>
                        <th class="number">Current number</th>
                        <th class="number">New Driver Number</th>
                        <th class="timestamp">Submitted at</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($drivernumberChangeRequests as $drivernumberChangeRequest)

                        <tr>
                            <td class="{{ strtolower($drivernumberChangeRequest->requeststatus->status) }}">{{ $drivernumberChangeRequest->requeststatus->status }}</td>
                            <td>{{ $drivernumberChangeRequest->driver->name }}</td>
                            <td class="number">{{ $drivernumberChangeRequest->driver->drivernumber }}</td>
                            <td class="number">{{ $drivernumberChangeRequest->new_drivernumber }}</td>
                            <td class="timestamp">{{ $drivernumberChangeRequest->created_at }}</td>
                            @if(strtolower($drivernumberChangeRequest->requeststatus->status) === "opened")
                                <td class="handle-request-button">
                                    <a href="{{ route('admin.requests.drivernumber.handle', ['id' => $drivernumberChangeRequest->id]) }}">Handle Request</a>
                                </td>
                            @else
                                <td class="awaiting-response">
                                    Awaiting Response
                                </td>
                            @endif
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="index-list-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Team transfer requests - {{ $teamTransferRequests->count() }}</h1>
            @endif

        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Driver</th>
                        <th>Current team</th>
                        <th>New team</th>
                        <th class="timestamp">Submitted at</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($teamTransferRequests as $teamTransferRequest)

                        <tr>
                            <td class="{{ strtolower($teamTransferRequest->requeststatus->status) }}">{{ $teamTransferRequest->requeststatus->status }}</td>
                            <td>{{ $teamTransferRequest->driver->name }}</td>
                            <td>{{ $teamTransferRequest->driver->team->name }}</td>
                            <td>{{ $teamTransferRequest->team->name }}</td>
                            <td class="timestamp">{{ $teamTransferRequest->created_at }}</td>
                            @if(strtolower($teamTransferRequest->requeststatus->status) === "opened")
                                <td class="handle-request-button">
                                    <a href="{{ route('admin.requests.teamtransfer.handle', ['id' => $teamTransferRequest->id]) }}">Handle Request</a>
                                </td>
                            @else
                                <td>
                                    Awaiting Response
                                </td>
                            @endif
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
