<?php

namespace App\Http\Controllers\Imah;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        $roles = Role::query()
            ->when(!blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('name', 'like', '%' . $request->search . '%');
            })
            ->with('permissions', function ($query) {
                return $query->select('id', 'name');
            })
            ->paginate(10);

        $permissions = Permission::orderBy('name')->get();

        return view('roles.index', [
            'title'     => 'Manajemen Role',
            'roles'     => $roles,
            'permissions'    => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        // validasi request role
        $validated = $request->validate([
            'name'          => 'required|unique:roles|max:100',
            'permission'    => 'nullable',
        ]);

        // convert string to array used explode function with separated comma
        $arr_permission = explode(',', $validated['permission']);
        // print_r($arr_permission);

        Role::create($validated)
            ->givePermissionTo(!blank($arr_permission) ? $arr_permission : array());

        return back()->with('success', 'Role baru berhasil dibuat');
    }

    public function update(Request $request, Role $role)
    {
        $rules = [
            'permissions.*' => 'nullable|string',
        ];
        if ($request->name != $role->name) {
            $rules['name'] = 'required|unique:roles|max:100';
        }
        $validated = $request->validate($rules);

        return $role->update($validated)
            && $role->syncPermissions(!blank($request->permissions) ? $validated['permissions'] : array())
            ? back()->with('success', 'Role berhasil diubah')
            : back()->with('failed', 'Role gagal diubah');
    }

    public function destroy(Role $role): RedirectResponse
    {
        return $role->delete()
            ? back()->with('success', 'Role ' . $role->name . ' berhasil dihapus!')
            : back()->with('failed', 'Role gagal dihapus!');
    }
}
