<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Illuminate\Http\Request;

class MonitoringPresensiController extends Controller
{
    public function presensi(Request $request)
    {
        $today = date('d');

        $presensis = Presensi::when(!blank($request->search), function ($query) use ($request) {
            return $query->whereRelation('user', 'name', 'like', '%' . $request->search . '%')
                ->orWhereRelation('user.jabatan', 'name', 'like', '%' . $request->search . '%');
        })
            ->whereDay('created_at', $today)
            ->latest()
            ->paginate(10);

        return view('backend.monitoring.presensi', [
            'title'     => 'Monitoring Presensi',
            'presensis' => $presensis,
        ]);
    }
}
