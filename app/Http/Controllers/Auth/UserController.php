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

    public function create(): View
    {
        return view('private.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();


        return redirect()->route('user')->with('status', 'User successfully created');
    }

    public function show(User $user): View
    {
        return view('private.users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        return view('private.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        if($request->password == "") {
            $user->name = $request->name;
            $user->email = $request->email;
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('user')->with('status', 'User successfully updated');
    }

    public function delete(User $user): View
    {
        return view('private.users.delete', compact('user'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('user')->with('status', 'User successfully deleted');
    }

    public function permissions(User $user): View
    {
        $roles = Role::all();
        $userRoles = Role::query()
            ->select('*')
            ->from("roles")
            ->whereIn("roles.name", $user->getRoleNames()->toArray())
            ->get();

        $permissions = Permission::all();
        $userPermissions = Permission::query()
            ->select('*')
            ->whereIn('permissions.name', $user->getPermissionNames()->toArray())
            ->get();

        return view('private.users.permissions', compact('user', 'roles', 'userRoles', 'permissions', 'userPermissions'));

    }

    public function updatepermissions(User $user, Request $request): RedirectResponse
    {
        $newPermissions = Permission::all()->where("id", "=", "-1");
        $newRoles = Role::all()->where("id", "=", "-1");

        foreach (Permission::all() as $permission)
        {
            if ($request->has("permission-" . $permission->id))
            {
                $newPermissions->add($permission);
            }
        }

        foreach (Role::all() as $role)
        {
            if ($request->has("role-" . $role->id))
            {
                $newRoles->add($role);
            }
        }

        $user->syncPermissions($newPermissions);
        $user->syncRoles($newRoles);

        return redirect()->route('user')->with('status', 'User permissions successfully updated');
    }
}
