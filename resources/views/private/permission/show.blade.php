@extends('layouts.private-layout')

@section('page-title') Permission - Show @endsection

@section('page') private-show @endsection

@section('content')

    <div class="show-container">

        <div class="table-header">

            <h1>Show Permission</h1>

        </div>

        <div class="show-content">

            <h1>Name</h1>
            <p>{{ $permission->name }}</p>

            <h1>Users using {{ $permission->name }}</h1>

            <ul>
                @if($users->count() > 0)
                    @foreach($users as $user)
                        <li>{{ $user->name }}</li>
                    @endforeach
                @else
                    <li>None</li>
                @endif
            </ul>

            <h1>Roles using {{ $permission->name }}</h1>

            <ul>
                @if($roles->count() > 0)
                    @foreach($roles as $role)
                        <li>{{ $role->name }}</li>
                    @endforeach
                @else
                    <li>None</li>
                @endif
            </ul>

        </div>
    </div>

@endsection
