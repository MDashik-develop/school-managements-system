<?php

namespace App\Http\Controllers\Backend\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule; // Don't forget to import Rule

class PermissionController extends Controller
{
    // Permission Create (Existing)
    public function createPermission()
    {
        return view('backend.permission.create-permission');
    }

    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return back()->with('success', 'Permission created successfully!');
    }

    // Role Create (Existing)
    public function createRole()
    {
        // We'll fetch all permissions to display on the create role page
        $permissions = Permission::all();
        return view('backend.permission.create-role', compact('permissions'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required|unique:roles,name', // Changed from 'name' to 'role_name' as per your HTML form
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->role_name]); // Use role_name for role creation

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('role.list')->with('success', 'Role created successfully!'); // Redirect to list page
    }

    // Role List
    public function indexRole()
    {
        $roles = Role::with('permissions')->get(); // Eager load permissions for display
        return view('backend.permission.list-roles', compact('roles'));
    }

    // Role Edit
    public function editRole(Role $role)
    {
        $permissions = Permission::all();
        // Get permissions assigned to the current role
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('backend.permission.edit-role', compact('role', 'permissions', 'rolePermissions'));
    }

    // Role Update
    public function updateRole(Request $request, Role $role)
    {
        $request->validate([
            'role_name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($role->id),
            ],
            'permissions' => 'array',
        ]);

        $role->update(['name' => $request->role_name]);

        // Sync permissions: detach all and then attach new ones
        $role->syncPermissions($request->permissions ?? []); // Use syncPermissions for efficiency

        return redirect()->route('role.list')->with('success', 'Role updated successfully!');
    }

    // Role Delete
    public function deleteRole(Role $role)
    {
        $role->delete();
        return redirect()->route('role.list')->with('success', 'Role deleted successfully!');
    }


    // Assign Role to User (Existing)
    public function assignRoleForm()
    {
        $users = User::all();
        $roles = Role::all();

        return view('backend.permission.assign-role', compact('users', 'roles'));
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->assignRole($request->role);

        return back()->with('success', 'Role assigned to user!');
    }
}