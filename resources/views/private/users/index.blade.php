@extends('layouts.private-layout')

@section('page-title') User - Index @endsection

@section('page') user-index @endsection

@section('content')

    <div class="user-table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="{{ route('user.permissions', ['user' => $user->id]) }}">Manage Permissions</a></td>
                        <td><a href="{{ route('user.show', ['user' => $user->id]) }}">Info</a></td>
                        <td><a href="{{ route('user.delete', ['user' => $user->id]) }}">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
