<?php

namespace App\Http\Controllers\Auth;

use \Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        return view('private.users.create');
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user')->with('status', 'User successfully created');
    }

    public function show(User $user)
    {
        return view('private.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('private.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        return redirect()->route('user')->with('status', 'User successfully updated');
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

    public function delete(User $user): View
    {
        return view('private.driver.delete', compact('user'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('user')->with('status', 'User successfully deleted');
    }
}
