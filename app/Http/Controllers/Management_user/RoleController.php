<?php

namespace App\Http\Controllers\Management_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_management_user', only: ['index']),
            new Middleware('permission:create_management_user', only: ['create']),
            new Middleware('permission:create_management_user', only: ['store']),
            new Middleware('permission:update_management_user', only: ['edit']),
            new Middleware('permission:update_management_user', only: ['update']),
            new Middleware('permission:delete_management_user', only: ['destroy']),
            new Middleware('permission:delete_management_user', only: ['destroy']),
            new Middleware('permission:update_management_user', only: ['addPermissionToRole']),
            new Middleware('permission:update_management_user', only: ['givePermissionToRole']),
        ];
    }

    public function index()
    {
        $roles = Role::get();
        return view('management_user.role.index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('management_user.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->name
        ]);

        return redirect('management_user/roles')->with('status', 'Role Berhasil Dibuat');
    }

    public function edit(Role $role)
    {
        return view('management_user.role.edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return redirect('management_user/roles')->with('status', 'Role Berhasil Diperbarui');
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();

        return redirect('management_user/roles')->with('status', 'Role Berhasil Dihapus');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::orderBy('created_at', 'desc')->get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = $role->permissions()->pluck('name')->toArray(); // Mengambil nama permission

        return view('management_user.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions, 
            'rolePermissions' => $rolePermissions
        ]);
    }


    public function givePermissionToRole(Request $request, $roleId)
    {
        // Validasi bahwa setidaknya ada satu permission yang dipilih
        $request->validate([
            'permission' => 'required|array',
        ]);

        // Ambil role berdasarkan ID
        $role = Role::findOrFail($roleId);

        // Sinkronkan permission yang diterima dari form
        $role->syncPermissions($request->permission);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('status', 'Permission Berhasil di Tambahkan');
    }


    
}
