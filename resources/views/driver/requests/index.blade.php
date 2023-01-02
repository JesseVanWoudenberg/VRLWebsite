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

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>New driver number</th>
                        <th>Submitted at</th>
                        <th>Returned at</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($drivernumberChangeRequests as $drivernumberChangeRequest)

                        <tr>
                            <td class="{{ strtolower($drivernumberChangeRequest->requeststatus->status) }}">{{ $drivernumberChangeRequest->requeststatus->status }}</td>
                            <td>{{ $drivernumberChangeRequest->new_drivernumber }}</td>
                            <td class="timestamp">{{ $drivernumberChangeRequest->created_at }}</td>
                            @if(strtolower($drivernumberChangeRequest->requeststatus->status) == "returned")
                                <td class="timestamp">{{ $drivernumberChangeRequest->updated_at }}</td>
                            @else
                                <td></td>
                            @endif

                            @if(strtolower($drivernumberChangeRequest->requeststatus->status) == "returned")

                                <td class="edit-button">
                                    <a href="{{ route('driverpanel.requests.drivernumber.edit', ['id' => $drivernumberChangeRequest->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>

                                        <span>
                                            Edit
                                        </span>
                                    </a>
                                </td>

                            @else

                                <td class="delete-button">
                                    <a href="{{ route('driverpanel.requests.drivernumber.delete', ['id' => $drivernumberChangeRequest->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                        </svg>

                                        <span>
                                            Delete
                                        </span>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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

        <div class="table-wrapper">
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

                            <td class="delete-button">
                                <a href="{{ route('driverpanel.requests.teamtransfer.delete', ['id' => $teamTransferChangeRequest->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                    </svg>

                                    <span>
                                        Delete
                                    </span>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
