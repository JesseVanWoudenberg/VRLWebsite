@php use App\Models\User; @endphp
@extends('layouts.public-layout')

@section('page-title')
    The Team
@endsection

@section('page')
    the-team
@endsection

@section('content')

    <div class="the-team-container">

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Developers</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach(User::role('developer')->get() as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Admins</th>
                    </tr>
                </thead>
                    @foreach(User::role('admin')->get() as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                        </tr>
                    @endforeach
                <tbody>

                </tbody>
            </table>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>FIA</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach(User::role('FIA')->get() as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
