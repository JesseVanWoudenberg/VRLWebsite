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

        <div class="comments">



        </div>

        <div class="form-container">



        </div>

    </div>

@endsection
