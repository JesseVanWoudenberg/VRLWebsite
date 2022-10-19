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
        $userRoles = Role::query()
            ->select('*')
            ->whereIn('roles.id',(function ($query) use ($user) {
                $query->from('model_has_roles')
                    ->select('model_id')
                    ->where('model_id','=', $user->id);
            }))
            ->get();

        $permissions = Permission::all();
        $userPermissions = Permission::query()
            ->select('*')
            ->whereIn('permissions.id', (function ($query) use ($user) {
                $query->from('model_has_permissions')
                    ->select('model_id')
                    ->where('model_id', '=', $user->id);
            }))
            ->get();

        return view('private.users.permissions', compact('user', 'roles', 'userRoles', 'permissions', 'userPermissions'));

    }

    public function delete(User $user) {

    }

    public function destroy(User $user)
    {
        //
    }
}
