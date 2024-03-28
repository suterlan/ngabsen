<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jabatans = Jabatan::query()
            ->when(!blank($request->search), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            })->paginate(10);

        return view('backend.jabatan.index', [
            'title'     => 'Jabatan',
            'jabatans'  => $jabatans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|max:64']);
        return Jabatan::create($validated)
            ? back()->with('success', 'Jabatan baru berhasil dibuat!')
            : back()->with('failed', 'Jabatan baru gagal dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $validated = $request->validate(['name' => 'required|max:64']);

        return $jabatan->update($validated)
            ? back()->with('success', 'Jabatan ' . $jabatan->name . ' berhasil diubah!')
            : back()->with('failed', 'Jabatan gagal diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        return $jabatan->delete()
            ? back()->with('success', 'Jabatan ' . $jabatan->name . ' berhasil dihapus!')
            : back()->with('failed', 'Jabatan gagal dihapus!');
    }
}
