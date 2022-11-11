@extends('layouts.private-layout')

@section('page-title') User - Permission @endsection

@section('page') user-permission @endsection

@section('content')


    <div class="permissions-container">

        <div class="user-permissions-container">

            @foreach($userPermissions as $userPermission)

                <div id="{{ $userPermission->permission_id }}" class="user-permission-item">
                    {{ \Spatie\Permission\Models\Permission::all()->where('id', '=', $userPermission->permission_id)->first()->name }}
                </div>

            @endforeach
        </div>

        <div class="all-permissions-container">

            @foreach($permissions as $permission)

                <div id="{{ $permission->id }}" class="permission-item">
                    {{ $permission->name }}
                </div>

            @endforeach
        </div>
    </div>

    <div class="roles-container">

        <div class="user-roles-container">
            @foreach($userRoles as $userRole)

                <div id="{{ $userRole->role_id }}" class="user-role-item">
                    {{ \Spatie\Permission\Models\Role::all()->where('id', '=', $userRole->name }}
                </div>

            @endforeach
        </div>

        <div class="all-roles-container">

            @foreach($roles as $role)

                <div id="{{ $role->id }}" class="role-item">
                    {{ $role->name  }}
                </div>

            @endforeach
        </div>
    </div>

@endsection
