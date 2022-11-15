@extends('layouts.private-layout')

@section('page-title') Role - Permissions @endsection

@section('page') user-permission @endsection

@section('content')

    <div class="user-permissions-page-container role-permissions-page-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>Role Edit</h1>
            @endif
        </div>

        <div class="user-permissions-form">

            <form action="{{ route('role.update-permissions', ['role' => $role->id]) }}" method="POST">

                @method('GET')
                @csrf

                <div class="perms-container">

                    <h1>Role Permissions</h1>

                    <ul>
                        @foreach($permissions as $permission)
                            <li>
                                <div class="permission">
                                    <input type="checkbox" name="permission-{{ $permission->id }}" value="permission-{{ $permission->id }}" id="permission-{{ $permission->id }}" @if($rolePermissions->where("id", "=", $permission->id)->count() > 0) checked @endif>
                                    <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <input type="submit" value="Update Permissions">
            </form>
        </div>
    </div>

@endsection
