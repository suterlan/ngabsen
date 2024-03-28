<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Settings::first();

        return view('backend.settings.index', [
            'title'    => 'Pengaturan',
            'setting'  => $setting,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'office_location'   => 'required',
            'radius'            => 'required|numeric',
        ]);

        $setting = Settings::updateOrCreate(
            ['slug' => $request->slug],
            [
                'office_location'  => $validated['office_location'],
                'radius'  => $validated['radius']
            ]
        );

        return $setting
            ? back()->with('success', 'Perubahan berhasil disimpan!')
            : back()->with('failed', 'Gagal menyimpan perubahan!');
    }
}
