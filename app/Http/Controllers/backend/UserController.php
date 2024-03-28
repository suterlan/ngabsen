<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->when(!blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            })
            ->with('roles', function ($query) {
                return $query->select('name');
            })
            ->with('jabatan', function ($query) {
                return $query->select('id', 'name');
            })
            ->latest()
            ->paginate(10);

        $roles = Role::where('name', '!=', 'super-admin')->orderBy('name')->get();
        return view('backend.users.index', [
            'title'     => 'Users',
            'users'     => $users,
            'roles'     => $roles,
        ]);
    }

    public function create(): View
    {
        return view('backend.users.create', [
            'title' => 'Tambah User',
            'roles' => Role::where('name', '!=', 'super-admin')->orderBy('name')->get(),
            'jabatans'  => Jabatan::select('id', 'name')->pluck('name', 'id'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return Redirect::route('users.create')->with('success', 'User baru berhasil dibuat.');
    }

    public function edit(User $user): View
    {

        return view('backend.users.edit', [
            'title' => 'Edit User',
            'user'  => $user,
            'jabatans'  => Jabatan::select('id', 'name')->pluck('name', 'id'),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'jabatan_id' => ['required'],
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|string|lowercase|email|max:255|unique:users,email';
        }

        $validated = $request->validate($rules);

        User::where('id', $user->id)
            ->update($validated);

        return back()->with('status', 'user-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $user->delete();

        return Redirect::route('users')->with('success', 'User ' . $user->email . ' berhasil di hapus.');
    }

    public function changeRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'roles.*' => 'nullable|string',
        ]);

        return $user->update($validated)
            && $user->syncRoles(!blank($request->roles) ? $validated['roles'] : array())
            ? back()->with('success', 'Perubahan role user berhasil')
            : back()->with('failed', 'Perubahan role user gagal');
    }
}
