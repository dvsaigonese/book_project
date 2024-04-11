<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.role.role');
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.role.create', compact('permissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);

        if ($role->name == 'Super-Admin') {
            return redirect()->back()->with('error', 'You can not edit Super Admin role!');
        } else {
            $permissions = Permission::all();
            $role_has_permissions = DB::table('role_has_permissions')
                ->where('role_id', '=', $role->id)
                ->get();

            return view('admin.role.edit', compact('role', 'permissions', 'role_has_permissions'));
        }
    }

    public function update($id, Request $request)
    {
        try {
            $role = Role::find($id);

            if ($role->name == 'Super-Admin') {
                return redirect()->back()->with('error', 'You can not edit Super Admin role!');
            } else {

                $role_has_permissions = DB::table('role_has_permissions')
                    ->where('role_id', '=', $role->id)
                    ->get();

                foreach ($role_has_permissions as $role_permission) {
                    $item = Permission::find($role_permission->permission_id);
                    $role->revokePermissionTo($item);
                }

                foreach ($request->get('permissions') as $permission) {
                    $item = Permission::find($permission);
                    $item->assignRole($role);
                }

                return view('admin.role.role')->with('toast', ['status' => 'success', 'message' => 'Updated Successfully!']);
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function store(Request $request)
    {
        try {
            $role = Role::create(['name' => $request->get('name')]);

            foreach ($request->get('permissions') as $permission) {
                $item = Permission::find($permission);
                $item->assignRole($role);
            }

            return view('admin.role.role')->with('toast', ['status' => 'success', 'message' => 'Created Successfully!']);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}


