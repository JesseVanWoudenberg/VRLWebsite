@extends('layouts.private-layout')

@section('page-title') Role - Index @endsection

@section('page') private-index @endsection

@section('content')

    <div class="index-list-container">

        <div class="table-header">

            @if(\Illuminate\Support\Facades\Session::exists('status'))
                <h1 @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'create')) class="created" @endif
                @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'delete')) class="deleted" @endif
                    @if(Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Session::get('status'), 'updated')) class="edited" @endif>
                    {{ \Illuminate\Support\Facades\Session::get('status') }}
                </h1>
            @elseif($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Manage Roles</h1>
            @endif

            <div class="index-buttons-container">
                <a href="{{ route('role.create') }}">
                    <img src="{{ asset('resources/media/svgs/plus-circle-fill.svg') }}" alt="X">
                    Add new role
                </a>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>

            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>

                        <td class="permissions-button">
                            <a href="{{ route('role.permissions', ['role' => $role->id]) }}">
                                <img src="{{ asset('resources/media/svgs/person-lines-fill.svg') }}" alt="X">
                                Manage Permissions
                            </a>
                        </td>

                        <td class="edit-button">
                            <a href="{{ route('role.edit', ['role' => $role->id]) }}">
                                <img src="{{ asset('resources/media/svgs/pencil-fill.svg') }}" alt="X">
                                Edit
                            </a>
                        </td>

                        <td class="delete-button">
                            <a href="{{ route('role.delete', ['role' => $role->id]) }}">
                                <img src="{{ asset('resources/media/svgs/x-circle-fill.svg') }}" alt="X">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection