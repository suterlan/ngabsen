<?php

namespace App\Http\Controllers\Imah;

use App\Http\Controllers\Controller;
use App\Http\Requests\UndanganRequest;
use App\Models\TemaUndangan;
use App\Models\Undangan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UndanganController extends Controller
{
    public function index(): View
    {
        $undangans = Undangan::with('temaundangan')->get();
        // dd($undangans);
        return view('undangan.index', [
            'title'     => 'Template Undangan',
            'undangans' => $undangans,
        ]);
    }

    public function create(): View
    {
        return view('undangan.create', [
            'title'     => 'Buat Template Undangan',
            'temas'     => TemaUndangan::pluck('nama', 'id'),
        ]);
    }

    public function store(UndanganRequest $request): RedirectResponse
    {
        // dd($request);
        // Retrieve the validated input data...
        $validated = $request->validated();

        $namawithoutspace = preg_replace('/\s+/', '', $validated['nama']);

        if ($request->file('bg_cover')) {
            $validated['bg_cover'] = $request->file('bg_cover')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('cover_dekor_tengah')) {
            $validated['cover_dekor_tengah'] = $request->file('cover_dekor_tengah')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('cover_dekor_atas_kanan')) {
            $validated['cover_dekor_atas_kanan'] = $request->file('cover_dekor_atas_kanan')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('cover_dekor_atas_kiri')) {
            $validated['cover_dekor_atas_kiri'] = $request->file('cover_dekor_atas_kiri')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('cover_dekor_bawah_kanan')) {
            $validated['cover_dekor_bawah_kanan'] = $request->file('cover_dekor_bawah_kanan')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('cover_dekor_bawah_kiri')) {
            $validated['cover_dekor_bawah_kiri'] = $request->file('cover_dekor_bawah_kiri')->store('undangan/' . $namawithoutspace);
        }

        if ($request->file('home_dekor_tengah')) {
            $validated['home_dekor_tengah'] = $request->file('home_dekor_tengah')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('home_dekor_atas_kanan')) {
            $validated['home_dekor_atas_kanan'] = $request->file('home_dekor_atas_kanan')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('home_dekor_atas_kiri')) {
            $validated['home_dekor_atas_kiri'] = $request->file('home_dekor_atas_kiri')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('home_dekor_bawah_kanan')) {
            $validated['home_dekor_bawah_kanan'] = $request->file('home_dekor_bawah_kanan')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('home_dekor_bawah_kiri')) {
            $validated['home_dekor_bawah_kiri'] = $request->file('home_dekor_bawah_kiri')->store('undangan/' . $namawithoutspace);
        }

        return Undangan::create($validated)
            ? back()->with('success', 'Undangan baru berhasil disimpan!')
            : back()->with('failed', 'Undangan baru gagal disimpan!');
    }

    public function edit(Undangan $undangan)
    {
        return view('undangan.edit', [
            'title'     => 'Edit Template Undangan',
            'temas'     => TemaUndangan::pluck('nama', 'id'),
            'undangan'  => $undangan,
        ]);
    }

    public function update(UndanganRequest $request, Undangan $undangan)
    {
        // dd($request);
        // Retrieve the validated input data...
        $validated = $request->validated();

        $namawithoutspace = preg_replace('/\s+/', '', $validated['nama']);

        if ($request->file('bg_cover')) {
            if ($request->old_bg_cover) {
                Storage::delete($request->old_bg_cover);
            }
            $validated['bg_cover'] = $request->file('bg_cover')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('cover_dekor_tengah')) {
            if ($request->old_cover_dekor_tengah) {
                Storage::delete($request->old_cover_dekor_tengah);
            }
            $validated['cover_dekor_tengah'] = $request->file('cover_dekor_tengah')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('cover_dekor_atas_kanan')) {
            if ($request->old_cover_dekor_atas_kanan) {
                Storage::delete($request->old_cover_dekor_atas_kanan);
            }
            $validated['cover_dekor_atas_kanan'] = $request->file('cover_dekor_atas_kanan')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('cover_dekor_atas_kiri')) {
            if ($request->old_cover_dekor_atas_kiri) {
                Storage::delete($request->old_cover_dekor_atas_kiri);
            }
            $validated['cover_dekor_atas_kiri'] = $request->file('cover_dekor_atas_kiri')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('cover_dekor_bawah_kanan')) {
            if ($request->old_cover_dekor_bawah_kanan) {
                Storage::delete($request->old_cover_dekor_bawah_kanan);
            }
            $validated['cover_dekor_bawah_kanan'] = $request->file('cover_dekor_bawah_kanan')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('cover_dekor_bawah_kiri')) {
            if ($request->old_cover_dekor_bawah_kiri) {
                Storage::delete($request->old_cover_dekor_bawah_kiri);
            }
            $validated['cover_dekor_bawah_kiri'] = $request->file('cover_dekor_bawah_kiri')->store('undangan/' . $namawithoutspace);
        }

        if ($request->file('home_dekor_tengah')) {
            if ($request->old_home_dekor_tengah) {
                Storage::delete($request->old_home_dekor_tengah);
            }
            $validated['home_dekor_tengah'] = $request->file('home_dekor_tengah')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('home_dekor_atas_kanan')) {
            if ($request->old_home_dekor_atas_kanan) {
                Storage::delete($request->old_home_dekor_atas_kanan);
            }
            $validated['home_dekor_atas_kanan'] = $request->file('home_dekor_atas_kanan')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('home_dekor_atas_kiri')) {
            if ($request->old_home_dekor_atas_kiri) {
                Storage::delete($request->old_home_dekor_atas_kiri);
            }
            $validated['home_dekor_atas_kiri'] = $request->file('home_dekor_atas_kiri')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('home_dekor_bawah_kanan')) {
            if ($request->old_home_dekor_bawah_kanan) {
                Storage::delete($request->old_home_dekor_bawah_kanan);
            }
            $validated['home_dekor_bawah_kanan'] = $request->file('home_dekor_bawah_kanan')->store('undangan/' . $namawithoutspace);
        }
        if ($request->file('home_dekor_bawah_kiri')) {
            if ($request->old_home_dekor_bawah_kiri) {
                Storage::delete($request->old_home_dekor_bawah_kiri);
            }
            $validated['home_dekor_bawah_kiri'] = $request->file('home_dekor_bawah_kiri')->store('undangan/' . $namawithoutspace);
        }

        return $undangan->update($validated)
            ? redirect(route('undangan'))->with('success', 'Undangan ' . $undangan->nama . ' berhasil diubah!')
            : back()->with('failed', 'Undangan ' . $undangan->nama . ' gagal diubah!');
    }

    public function destroy(Undangan $undangan)
    {

        Undangan::destroy($undangan->id);

        $directory = 'undangan/' . str_replace(' ', '', $undangan->nama);

        if ($undangan->bg_cover || $undangan->cover_dekor_tengah || $undangan->cover_dekor_atas_kanan || $undangan->cover_dekor_atas_kiri || $undangan->cover_dekor_bawah_kanan || $undangan->cover_dekor_bawah_kiri || $undangan->home_dekor_tengah || $undangan->home_dekor_atas_kanan || $undangan->home_dekor_atas_kiri || $undangan->home_dekor_bawah_kanan || $undangan->home_dekor_bawah_kiri) {
            Storage::deleteDirectory($directory);
        }
        return back()->with('success', 'Undangan ' . $undangan->nama . ' berhasil dihapus!');
    }
}
