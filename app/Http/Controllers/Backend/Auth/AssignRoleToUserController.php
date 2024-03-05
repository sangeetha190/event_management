<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AssignRoleToUserController extends Controller
{
    //

    public function index()
    {
        $users = User::with('roles')->get();
        // return $user;
        return view('admin.Assign_User_Role Management.index', compact('users'));
    }
    public function create()
    {
        $users = User::get();
        $roles = Role::get();
        return view('admin.Assign_User_Role Management.create', compact('users', 'roles'));
    }
    public function store(Request $request)
    {
        // return $request;
        $user = User::find($request->user_id);
        $user->syncRoles($request->role_id);
        // $role = Role::find($request->role_id);
        // $user->assignRole($role->name);
        return redirect()->back()->with('message', "Assigned to $user->email successfully");
    }

    public function edit($id)
    {
        $Selecteduser = User::with('roles')->find($id);
        $users = User::get();
        $roles = Role::get();
        return view('admin.Assign_User_Role Management.edit', compact('Selecteduser', 'roles', 'users'));
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->syncRoles($request->role_id);
        // $role = Role::find($request->role_id);
        // return (array)$role->name;
        // $user->syncRoles((array)$role->name);
        // $user->syncRoles($role->name);
        return redirect()->back()->with('message', "Role Updataed to $user->email successfully");
    }
    public function delete($id)
    {
        // return $id;
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->back()->with('message', 'User deleted successfully');
    }
}
