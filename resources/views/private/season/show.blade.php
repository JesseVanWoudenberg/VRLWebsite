@extends('layouts.private-layout')

@section('page-title') Season - Show @endsection

@section('page') season-show @endsection

@section('content')

    <div class="show-container">
        <table>
            <tr>
                <th>Season Number</th>
                <td>{{ $season->seasonnumber }}</td>
            </tr>

            <tr>
                <th>Tier number</th>
                <td>{{ $season->tier->tiernumber }}</td>
            </tr>
        </table>
    </div>

@endsection
