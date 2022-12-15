<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class roleController extends Controller
{
    // Untuk memanggil halaman index role (Backend)
    public function index()
    {
        $id = Auth::id();
        $roles = Role::all();
        return view(
            'backend.role.index',
            compact(
                'roles',
            )
        );
    }

    // Untuk memanggil halaman create role (Backend)
    public function create()
    {
        $permission = Permission::get();
        return view(
            'backend.role.create',
            compact(
                'permission'
            )
        );
    }

    // Untuk menyimpan data role yang telah dibuat pada halaman create (Backend)
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->givePermissionTo($request->input('permission'));

        return redirect()->route('role.index')->with('success', 'Role Berhasil Di Tambahkan');
    }

    // Untuk memanggil halaman show role (Backend)
    public function show($id)
    {
        $role = Role::find($id);
        $getAllPermissions = $role->getAllPermissions()->all();
        foreach ($getAllPermissions as $permission) {
            $permissions[] = $permission->name;
        }

        return view('backend.role.show')->with([
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    // Untuk memanggil halaman edit (Backend)
    public function edit($id)
    {
        $role = Role::find($id);
        $getAllPermissions = $role->getAllPermissions()->all();
        foreach ($getAllPermissions as $permission) {
            $permissions[] = $permission->name;
        }
        return view('backend.role.edit')->with([
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    // Untuk menyimpan data yang telah diubah pada halaman edit (Backend)
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->permission);

        return redirect()->route('role.index')
            ->with('success', 'Role Berhasil Di Edit');
    }

    // Untuk menghapus data role (Backend)
    public function destroy($id)
    {
        $role = Role::find($id)->delete();
        return redirect()->route('role.index')->with('success', 'Data Berhasil Di Hapus');
    }
}