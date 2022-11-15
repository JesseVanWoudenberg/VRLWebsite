<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::all();

        return view('private.role.index', compact('roles'));
    }

    public function create(): View
    {
        return view('private.role.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Role::create(['name' => $request->input("name")]);

        return redirect()->route('role')->with('status', 'Role successfully created');
    }

    public function edit(Role $role)
    {
        return view('private.role.edit', compact('role'));
    }

    public function delete(): View
    {
        return view('private.role.delete');
    }
    
    public function destroy(Role $role): RedirectResponse
    {
        $users = $role->users();

        foreach ($users as $user)
        {
            $user->removeRole($role);
        }

        $role->delete();

        return redirect()->route('role')->with('status', 'Role successfully deleted');
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $newPermissions = Permission::all()->where("id", "=", "-1");;

        foreach (Permission::all() as $permission)
        {
            if ($request->has("permission-" . $permission->id))
            {
                $newPermissions->add($permission);
            }
        }

        $role->syncPermissions();

        return redirect()->route('role')->with('status', 'Role successfully updated');
    }
}
