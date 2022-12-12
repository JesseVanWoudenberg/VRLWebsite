<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(): View
    {
        User::checkPermissions("permission index");

        $permissions = Permission::all();
//        $permissions = Permission::paginate(10);

        return view('private.permission.index', compact('permissions'));
    }

    public function create(): View
    {
        User::checkPermissions("permission create");

        return view('private.permission.create');
    }

    public function store(Request $request): RedirectResponse
    {
        User::checkPermissions("permission create");

        Permission::create(['name' => $request->name]);

        $log = new Log();
        $log->action = "Stored permission [ Name: " . $request->name . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('permission')->with('status', 'Permission successfully created');
    }

    public function show(Permission $permission): View
    {
        User::checkPermissions("permission show");

        $users = User::query()
            ->select('*')
            ->whereIn('users.id',(function ($query) use ($permission) {
                $query->from('model_has_permissions')
                    ->select('model_id')
                    ->where('permission_id', '=', $permission->id);
            }))
            ->get();

        $roles = Role::query()
            ->select('*')
            ->whereIn('roles.id',(function ($query) use ($permission) {
                $query->from('role_has_permissions')
                    ->select('role_id')
                    ->where('permission_id', '=', $permission->id);
            }))
            ->get();

        return view('private.permission.show', compact('permission', 'users', 'roles'));
    }

    public function edit(Permission $permission): View
    {
        User::checkPermissions("permission edit");

        return view('private.permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        User::checkPermissions("permission edit");

        $oldname = $permission->name;

        $permission->name = $request->name;
        $permission->save();

        $log = new Log();
        $log->action = "Updated permission [ ID: " . $permission->id . ", Old name: " . $oldname . ", New name: " . $permission->name . " ]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('permission')->with('status', 'Permission successfully updated');
    }

    public function delete(Permission $permission): View
    {
        User::checkPermissions("permission delete");

        return view('private.permission.delete', compact('permission'));
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        User::checkPermissions("permission delete");

        $permission->delete();

        $log = new Log();
        $log->action = "Deleted permission [ ID: " . $permission->id . ", Permission name: " . $permission->name . "]";
        $log->user_id = intval(Auth::id());
        $log->save();

        return redirect()->route('permission')->with('status', 'Permission successfully deleted');
    }
}
