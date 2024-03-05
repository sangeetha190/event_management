<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;
// use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        // $roles =  Role::get();
        // return $roles;
        $roles = Role::with('permissions')->get();
        return view('admin.Role Management.index', compact('roles'));
    }
    public function create()
    {

        $permissionGroups = PermissionGroup::with('permissions')->get();
        return view('admin.Role Management.create', compact('permissionGroups'));
    }
    public function store(Request $request)
    {
        // return $request;
        $role = new Role;
        $role->name = $request->name;
        $role->save();


        // Check if permissions are selected before syncing
        if ($request->has('permission_id') && is_array($request->permission_id)) {
            // Convert permission IDs to Permission objects
            $permissions = Permission::whereIn('id', $request->permission_id)->get();

            // Sync the permissions with the role
            $role->syncPermissions($permissions);
        }

        // if ($request->has('permission_id') && is_array($request->permission_ids)) {
        //     // Convert permission IDs to Permission objects
        //     $permissions = Permission::whereIn('id', $request->permission_ids)->get();

        //     // Sync the permissions with the role
        //     $role->syncPermissions($permissions);
        // }

        // $permission_id = $request->permission_id;
        // $role->syncPermissions($permission_id);
        // $role->syncPermissions($request->permission_id);
        // return redirect()->back()->with('message', 'Role Created with Selected Permissions Successfully');
        // if ($request->has('permission') && is_array($request->permission_ids)) {

        //     $permissions = Permission::whereIn('id', $request->permission_ids)->get();

        //     $role->syncPermissions($permissions);
        // }

        // $sample = $request->permission_ids;
        // $role->syncPermissions($sample);
        // return redirect()->route('role.list')
        //     ->with('success', 'Role created successfully');
        // $sample = $request->permission_ids;
        // $role->syncPermissions($sample);
        return redirect()->back()->with('message', 'Role Created with Selected Permissions Successfully!!');
    }
    public function edit($id)
    {
        $role = Role::with('permissions')->find($id);
        $permissionGroups = PermissionGroup::with('permissions')->get();
        return view('admin.Role Management.edit', compact('role', 'permissionGroups'));
    }
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        // Check if permissions are selected before syncing
        if ($request->has('permission_id') && is_array($request->permission_id)) {
            // Convert permission IDs to Permission objects
            $permissions = Permission::whereIn('id', $request->permission_id)->get();

            // Sync the permissions with the role
            $role->syncPermissions($permissions);
        }

        return redirect()->back()->with('message', 'Role Updated with Selected Permissions Successfully!!');
    }
    public function delete($id)
    {
        $role = Role::findById($id);
        $role->delete();
        return redirect()->back()->with('message', 'Role Deleted with Selected Permissions Successfully!!');
    }
}
