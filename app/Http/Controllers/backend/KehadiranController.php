<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Izin;
use App\Models\Presensi;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public $setting = '';
    function __construct()
    {
        $this->setting = Settings::first();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::all()->sortByDesc('data.is_end')->sortByDesc('data.is_start');
        return view('backend.kehadiran.index', [
            'title'         => 'Daftar Absensi',
            'attendances'   => $attendances,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        $attendance->load(['jabatans', 'presences']);
        $presence = Presensi::where('attendance_id', $attendance->id)
            ->with('user')
            ->orderByDesc('presence_date');

        if (request('search')) {
            $presence->whereRelation('user', 'name', 'like', '%' . request('search') . '%');
        }

        if (request('filter_by_date')) {
            $presence->where('presence_date', request('filter_by_date'));
        }

        $presences = $presence->paginate(10);
        // dd($presences);

        return view('backend.kehadiran.show', [
            'title'         => 'Detail Kehadiran',
            'attendance'    => $attendance,
            'presences'     => $presences,
        ]);
    }

    public function showIzin(Attendance $attendance)
    {
        $attendance->load(['jabatans', 'presences']);

        $byDate = now()->toDateString();
        if (request('filter_by_date'))
            $byDate = request('filter_by_date');

        $izins = Izin::query()
            ->with(['user', 'user.jabatan'])
            ->where('attendance_id', $attendance->id)
            ->where('permission_date', $byDate)
            ->get();

        return view('backend.kehadiran.izin', [
            'title'         => 'Data Karyawan Izin',
            'attendance'    => $attendance,
            'izins'         => $izins,
            'date'          => $byDate,
        ]);
    }

    public function approveIzin(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'user_id' => 'required|string|numeric',
            'permission_date'   => 'required|date',
            'location'          => 'required',
        ]);

        $user = User::findOrFail($validated['user_id']);

        $izin = Izin::query()
            ->where('attendance_id', $attendance->id)
            ->where('user_id', $user->id)
            ->where('permission_date', $validated['permission_date'])
            ->first();

        $checkPresence = Presensi::query()
            ->where('attendance_id', $attendance->id)
            ->where('user_id', $user->id)
            ->where('presence_date', $validated['permission_date'])
            ->first();

        // Jika data user dari request sudah absen (ada di tabel presensi)
        // atau data user ternyata tidak ada di tebel user 
        if ($checkPresence || !$user)
            return back()->with('failed', 'Proses gagal, data user sudah absen atau tidak ada!');

        Presensi::create([
            'user_id'          => $user->id,
            'attendance_id'    => $attendance->id,
            'presence_date'    => $validated['permission_date'],
            'entry_time'       => now()->toTimeString(),
            'out_time'         => now()->toTimeString(),
            'entry_location'   => $validated['location'],
            'out_location'     => $validated['location'],
            'is_izin'          => true
        ]);

        $izin->update([
            'is_accepted' => 1
        ]);

        return back()
            ->with('success', "Berhasil menyetujui izin karyawan atas nama \"$user->name\".");
    }

    public function notPresent(Attendance $attendance)
    {
        $byDate = now()->toDateString();
        if (request('filter_by_date'))
            $byDate = request('filter_by_date');

        $presences = Presensi::query()
            ->where('attendance_id', $attendance->id)
            ->where('presence_date', $byDate)
            ->get(['presence_date', 'user_id']);

        // jika semua karyawan tidak hadir
        if ($presences->isEmpty()) {
            $notPresentData[] =
                [
                    "not_presence_date" => $byDate,
                    "users" => User::query()
                        ->withoutRole('super-admin')
                        ->paginate(10)
                ];
        } else {
            $notPresentData = $this->getNotPresentEmployees($presences);
        }
        // dd($notPresentData);

        return view('backend.kehadiran.not-present', [
            'title'             => 'Data Karyawan Tidak Hadir',
            "attendance"        => $attendance,
            "notPresentData"    => $notPresentData
        ]);
    }

    private function getNotPresentEmployees($presences)
    {
        $uniquePresenceDates = $presences->unique("presence_date")->pluck('presence_date');
        $uniquePresenceDatesAndCompactTheUserIds = $uniquePresenceDates->map(function ($date) use ($presences) {
            return [
                "presence_date" => $date,
                "user_ids" => $presences->where('presence_date', $date)->pluck('user_id')->toArray()
            ];
        });
        $notPresentData = [];
        foreach ($uniquePresenceDatesAndCompactTheUserIds as $presence) {
            $notPresentData[] =
                [
                    "not_presence_date" => $presence['presence_date'],
                    "users" => User::query()
                        ->withoutRole('super-admin')
                        ->whereNotIn('id', $presence['user_ids'])
                        ->paginate(10)
                ];
        }
        return $notPresentData;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function Present(Request $request, Attendance $attendance)
    {
        // dd($request);
        $user = User::findOrFail($request->user_id);

        $checkPresence = Presensi::query()
            ->where('attendance_id', $attendance->id)
            ->where('user_id', $user->id)
            ->where('presence_date', $request->presence_date)
            ->first();

        // Jika data user dari request sudah absen (ada di tabel presensi)
        // atau data user ternyata tidak ada di tebel user 
        if ($checkPresence || !$user)
            return back()->with('failed', 'Proses gagal, data user sudah absen atau tidak ada!');

        Presensi::create([
            'user_id'          => $user->id,
            'attendance_id'    => $attendance->id,
            'presence_date'    => $request->presence_date,
            'entry_time'       => now()->toTimeString(),
            'out_time'         => now()->toTimeString(),
            'entry_location'   => $this->setting->office_location,
            'out_location'     => $this->setting->office_location,
            'is_izin'          => false
        ]);

        return back()
            ->with('success', "Berhasil menghadirkan karyawan atas nama \"$user->name\".");
    }
}
