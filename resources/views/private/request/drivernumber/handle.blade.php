@extends('layouts.private-layout')

@section('page-title')
    Request - Handle
@endsection

@section('page')
    drivernumber-request-handle
@endsection

@section('content')

    <div class="drivernumber-request-handle-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Drivernumber change request handle</h1>
            @endif

        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Driver name</th>
                        <th>Old drivernumber</th>
                        <th>New drivernumber</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{ $drivernumberChangeRequest->driver->name }}</td>
                        <td>{{ $drivernumberChangeRequest->driver->drivernumber }}</td>
                        <td>{{ $drivernumberChangeRequest->new_drivernumber }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-container">

            <div class="accept-form">
                <form action="{{ route('admin.requests.drivernumber.handle-decision', ['id' => $drivernumberChangeRequest->id]) }}" method="POST">

                    @method('GET')
                    @csrf

                    <input type="hidden" name="decision" value="Accept">

                    <input type="submit" value="Accept">
                </form>
            </div>

            <div class="deny-form">
                <form action="{{ route('admin.requests.drivernumber.handle-decision', ['id' => $drivernumberChangeRequest->id]) }}" method="POST">

                    @method('GET')
                    @csrf

                    <input type="submit" value="Deny">

                    <input type="hidden" name="decision" value="Deny">

                    <label for="reason">Reason to deny</label>
                    <textarea name="reason" id="reason" maxlength="500"></textarea>

                </form>
            </div>
        </div>
    </div>

@endsection
