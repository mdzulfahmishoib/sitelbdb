<?php

namespace App\Http\Controllers\Management_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
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
        ];
    }

    public function index()
    {
        // Ambil semua data permission dan urutkan berdasarkan waktu pembuatan terbaru
        $permissions = Permission::get();

        // Kirimkan data ke view dengan nama variabel yang konsisten
        return view('management_user.permission.index', [
            'permissions' => $permissions // Ganti 'permission' dengan 'permissions'
        ]);
    }
   

    public function create(){
        return view('management_user.permission.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=> [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('status', 'Permission Berhasil Dibuat');
    }

    public function edit(Permission $permission){
        return view('management_user.permission.edit', [
            'permission' => $permission
        ]);
        
    }

    public function update(Request $request, Permission $permission){
        $request->validate([
            'name'=> [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect('management_user/permission')->with('status', 'Permission Berhasil Diperbarui');
    }

    public function destroy($permissionId){
        $permission = Permission::find($permissionId);
        $permission->delete();

        return redirect('management_user/permission')->with('status', 'Permission Berhasil Dihapus');

    }
}
