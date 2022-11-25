@extends('layouts.private-layout')

@section('page-title') User - Permission @endsection

@section('page') user-permission @endsection

@section('content')

    <div class="user-permissions-page-container">

        <div class="table-header">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <h1>{{ $error }}</h1>
                @endforeach
            @else
                <h1>User Permissions</h1>
            @endif
        </div>

        <div class="user-permissions-form">

            <form action="{{ route('user.update-permissions', ['user' => $user->id]) }}" method="POST">

                @method('GET')
                @csrf

                <div class="perms-container">

                    <h1>User Permissions</h1>

                    <ul>
                        @foreach($permissions as $permission)
                            <li>
                                <div class="permission">
                                    <input type="checkbox" name="permission-{{ $permission->id }}" value="permission-{{ $permission->id }}" id="permission-{{ $permission->id }}" @if($userPermissions->where("id", "=", $permission->id)->count() > 0) checked @endif>
                                    <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="roles-container">

                    <h1>User Roles</h1>

                    <ul>
                        @foreach($roles as $role)
                            <li>
                                <div class="permission">
                                    <input type="checkbox" name="role-{{ $role->id }}" value="role-{{ $role->id }}" id="role-{{ $role->id }}" @if($userRoles->where("id", "=", $role->id)->count() > 0) checked @endif>
                                    <label for="role-{{ $role->id }}">{{ $role->name }}</label>
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
