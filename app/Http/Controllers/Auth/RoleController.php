<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        User::checkPermissions("role index");

        $roles = Role::all();

        return view('private.role.index', compact('roles'));
    }

    public function create(): View
    {
        User::checkPermissions("role create");

        return view('private.role.create');
    }

    public function store(Request $request): RedirectResponse
    {
        User::checkPermissions("role create");

        Role::create(['name' => $request->input("name")]);

        $log = new Log();
        $log->action = "Stored role [ Name: " . $request->name . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('role')->with('status', 'Role successfully created');
    }

    public function edit(Role $role)
    {
        User::checkPermissions("role edit");

        return view('private.role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        User::checkPermissions("role edit");

        $oldname = $role->name;

        $role->name = $request->name;
        $role->save();

        $log = new Log();
        $log->action = "Updated permission [ ID: " . $role->id . ", Old name: " . $oldname . ", New name: " . $role->name . " ]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('role')->with('status', $role->name . ' successfully updated');
    }

    public function delete(Role $role): View
    {
        User::checkPermissions("role delete");

        return view('private.role.delete', compact('role'));
    }

    public function destroy(Role $role): RedirectResponse
    {
        User::checkPermissions("role delete");

        $users = User::query()
            ->select('*')
            ->whereIn('id',(function ($query) use ($role) {
                $query->from('model_has_roles')
                    ->select('model_id')
                    ->where('role_id','=', $role->id);
            }))
            ->get();

        foreach ($users as $user)
        {
            $user->removeRole($role);
        }

        $role->delete();

        $log = new Log();
        $log->action = "Deleted permission [ ID: " . $role->id . ", Permission name: " . $role->name . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('role')->with('status', 'Role successfully deleted');
    }

    public function permissions(Role $role): View
    {
        User::checkPermissions("role permissions");

        $permissions = Permission::all();
        $rolePermissions = Permission::query()
            ->select('*')
            ->whereIn('permissions.name', $role->getPermissionNames()->toArray())
            ->get();

        return view('private.role.permissions', compact('role', 'permissions', 'rolePermissions'));

    }

    public function updatepermissions(Request $request, Role $role): RedirectResponse
    {
        User::checkPermissions("role permissions");

        $newPermissions = Permission::all()->where("id", "=", "-1");;

        foreach (Permission::all() as $permission)
        {
            if ($request->has("permission-" . $permission->id))
            {
                $newPermissions->add($permission);
            }
        }

        $role->syncPermissions($newPermissions);

        return redirect()->route('role')->with('status', $role->name . '\'s roles successfully updated');
    }
}
