<?php

namespace App\Http\Controllers\Imah;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(Request $request): View
    {
        $permissions = Permission::select('id', 'name')
            ->when(!blank($request->search), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->with('roles', function ($query) {
                return $query->select('id', 'name');
            })
            ->paginate(10);

        $roles = Role::orderBy('name')->get();

        return view('permissions.index', [
            'title'         => 'Permissions',
            'permissions'   => $permissions,
            'roles'         => $roles,
        ]);
    }

    public function store(Request $request)
    {
        // validasi request permission
        $validated = $request->validate([
            'name'     => 'required|unique:permissions|max:100',
            'roles'    => 'nullable',
        ]);

        // convert string to array used explode function with separated comma
        $arr_roles = explode(',', $validated['roles']);
        // print_r($arr_roles);

        Permission::create($validated)
            ->assignRole(!blank($arr_roles) ? $arr_roles : array());

        return back()->with('success', 'Permission baru berhasil dibuat');
    }

    public function update(Request $request, Permission $permission)
    {
        $rules = [
            'roles.*' => 'nullable|string',
        ];
        if ($request->name != $permission->name) {
            $rules['name'] = 'required|unique:permissions|max:100';
        }
        $validated = $request->validate($rules);

        return $permission->update($validated)
            && $permission->syncRoles(!blank($request->roles) ? $validated['roles'] : array())
            ? back()->with('success', 'Permission berhasil diubah')
            : back()->with('failed', 'Permission gagal diubah');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        return $permission->delete()
            ? back()->with('success', 'Permission ' . $permission->name . ' berhasil dihapus!')
            : back()->with('failed', 'Permission gagal dihapus!');
    }
}
