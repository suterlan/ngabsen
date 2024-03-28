<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::latest()
            ->when(!blank(request('search')), function ($query) {
                return $query->where('title', 'like', '%' . request('search') . '%');
            })
            ->paginate(10);

        return view('backend.attendance.index', [
            'title'     => 'Absensi',
            'attendances'   => $attendances,
        ]);
    }

    public function create()
    {
        return view('backend.attendance.create', [
            'title'     => 'Buat Absensi',
            'jabatans'  => Jabatan::select('id', 'name')->pluck('name', 'id'),
        ]);
    }

    public function store(AttendanceRequest $request)
    {
        $jabatan_ids = array_values($request->jabatan_ids);

        // dd($jabatan_ids);

        if (!blank($request['code'])) { // jika menggunakan qrcode
            $request['code'] = Str::random();
        }

        $attendance = Attendance::create($request->validated());
        $attendance->jabatans()->attach($jabatan_ids);

        if ($attendance) {
            return redirect(route('admin.attendance.index'))->with('success', 'Data absensi berhasil ditambahkan!');
        } else {
            back()->with('failed', 'Data absensi gagal ditambahkan!');
        }
    }

    public function edit(Attendance $attendance)
    {
        return view('backend.attendance.edit', [
            'title'         => 'Edit Absensi',
            'attendance'    => $attendance->load('jabatans'),
            'jabatans'      => Jabatan::latest()->with('attendances')->get(),
        ]);
    }

    public function update(Attendance $attendance, AttendanceRequest $request)
    {
        // get array value of array jabatan_ids
        $jabatan_ids = array_values($request->jabatan_ids);

        $attendance->fill($request->validated());
        // cek code jika kosong ("null") pada checkbox
        if (blank($request->code)) {
            $attendance['code'] = null;
        } else {
            // cek lagi jika ada oldCode (sudah ada code sebelumnya)
            if ($request->oldCode) {
                $attendance['code'] = $request->oldCode;
            } else {
                $attendance['code'] = Str::random();
            }
        }

        $attendance->save();
        $attendance->jabatans()->sync($jabatan_ids);

        if ($attendance) {
            return redirect(route('admin.attendance.index'))->with('success', 'Data absensi berhasil diubah!');
        } else {
            back()->with('failed', 'Data absensi gagal diubah!');
        }
    }

    public function destroy(Attendance $attendance)
    {
        return $attendance->delete()
            ? back()->with('success', 'Data absensi ' . $attendance->title . ' berhasil dihapus!')
            : back()->with('failed', 'Data absensi gagal dihapus!');
    }
}
