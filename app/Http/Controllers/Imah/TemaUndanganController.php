<?php

namespace App\Http\Controllers\Imah;

use App\Http\Controllers\Controller;
use App\Models\TemaUndangan;
use Illuminate\Http\Request;

class TemaUndanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $temas = TemaUndangan::latest()
            ->when(!blank($request->search), function ($query) use ($request) {
                return $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->paginate(10);

        return view('tema-undangan.index', [
            'title'     => 'Tema Undangan',
            'temas'     => $temas,
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
        $validated = $request->validate([
            'nama'  => 'required|max:100',
        ]);
        TemaUndangan::create($validated);
        return redirect(route('temaundangan.index'))->with('success', 'Tema baru berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(TemaUndangan $temaundangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TemaUndangan $temaundangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TemaUndangan $temaundangan)
    {
        $validated = $request->validate([
            'nama'  => 'required|max:100',
        ]);

        return $temaundangan->update($validated)
            ? back()->with('success', 'Tema ' . $temaundangan->nama . ' berhasil diubah!')
            : back()->with('failed', 'Tema ' . $temaundangan->nama . ' gagal diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TemaUndangan $temaundangan)
    {
        return $temaundangan->delete()
            ? back()->with('success', 'Tema ' . $temaundangan->nama . ' berhasil dihapus!')
            : back()->with('failed', 'Tema ' . $temaundangan->nama . ' gagal dihapus!');
    }
}
