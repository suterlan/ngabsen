<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Izin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        $izinHistories = Izin::where('user_id', $user_id)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->orderBy('permission_date', 'desc')
            ->get();

        return view('frontend.izin.index', [
            'title'     => 'Izin',
            'izinHistories' => $izinHistories,

        ]);
    }

    public function create()
    {
        $attendances = Attendance::query()
            ->forCurrentUser(auth()->user()->jabatan_id)
            ->get()
            ->sortByDesc('data.is_end')
            ->sortByDesc('data.is_start');

        return view('frontend.izin.create', [
            'title'     => 'Buat Izin',
            'attendances'   => $attendances,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'permission_date'   => 'required',
            'attendance_id'     => 'required',
            'title'             => 'required',
            'description'       => 'required',
            'location'          => 'required',
        ]);

        return Izin::create([
            'user_id'           => Auth::user()->id,
            'permission_date'   => $validated['permission_date'],
            'attendance_id'     => $validated['attendance_id'],
            'title'             => $validated['title'],
            'description'       => $validated['description'],
            'location'          => $validated['location'],
        ])
            ? redirect(route('izin'))->with('success', 'Berhasil, data sudah terkirim!')
            : back()->with('failed', 'Gagal, data tidak terkirim!');
    }
}
