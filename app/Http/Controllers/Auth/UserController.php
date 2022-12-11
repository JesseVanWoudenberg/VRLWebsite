<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\UserRequests\UserStoreRequest;
use App\Http\Requests\UserRequests\UserUpdateRequest;
use App\Models\Driver;
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
        User::checkPermissions("user index");

        $users = User::all();

        return view('private.users.index', compact('users'));
    }

    public function create(): View
    {
        User::checkPermissions("user create");

        $drivers = Driver::all();

        return view('private.users.create', compact('drivers'));
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        User::checkPermissions("user create");

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($request->driver_id != "none") {
            $user->driver_id = $request->driver_id;
        }
        $user->save();

        return redirect()->route('user')->with('status', 'User successfully created');
    }

    public function show(User $user): View
    {
        User::checkPermissions("permission show");

        return view('private.users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        User::checkPermissions("permission edit");

        $drivers = Driver::all();

        return view('private.users.edit', compact('user', 'drivers'));
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        User::checkPermissions("permission edit");

        if($request->password == "") {
            $user->name = $request->name;
            $user->email = $request->email;
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
        }
        if ($request->driver_id != "none") {
            $user->driver_id = $request->driver_id;
        } else {
            $user->driver_id = null;
        }

        $user->save();

        return redirect()->route('user')->with('status', 'User successfully updated');
    }

    public function delete(User $user): View
    {
        User::checkPermissions("permission delete");

        return view('private.users.delete', compact('user'));
    }

    public function destroy(User $user): RedirectResponse
    {
        User::checkPermissions("permission delete");

        $user->delete();

        return redirect()->route('user')->with('status', 'User successfully deleted');
    }

    public function permissions(User $user): View
    {
        User::checkPermissions("user permissions");

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
        User::checkPermissions("user permissions");

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
