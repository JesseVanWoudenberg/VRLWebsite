<?php

namespace App\Http\Controllers\Auth;

use \Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index(): View
    {
        $users = User::all();

        return view('private.users.index', compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function permissions(User $user)
    {

        $roles = Role::all();

        $userRoles = DB::select
        (
            'SELECT *
                   FROM model_has_roles
                   WHERE model_id = ' . $user->id
        );

        foreach ($roles as $role)
        {
            foreach ($userRoles as $userRole)
            {
                if ($role->id == $userRole->role_id)
                {
                    $roles->pull($roles->search($role));
                }
            }
        }

        $permissions = Permission::all();

        $userPermissions = DB::select
        (
            'SELECT *
                   FROM model_has_permissions
                   WHERE model_id = ' . $user->id
        );

        foreach ($permissions as $permission)
        {
            foreach ($userPermissions as $userPermission)
            {
                if ($permission->id == $userPermission->permission_id)
                {
                    $permissions->pull($permissions->search($permission));
                }
            }
        }

        return \view('private.users.permissions', compact('user', 'roles', 'userRoles', 'permissions', 'userPermissions'));

    }

    public function delete(User $user) {

    }

    public function destroy(User $user)
    {
        //
    }
}
