<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Izin;
use App\Models\Presensi;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $currentMonth = date('m');
        $thisYear = date('Y');
        $user_id = Auth::user()->id;

        $presensi = Presensi::where('user_id', $user_id)->latest();

        $histories = $presensi->get();

        $dateFrom = Carbon::now()->subDays(6)->toDateString();
        // periode tanggal (satu minggu)
        $period = CarbonPeriod::create($dateFrom, 'now')
            ->filter(function ($period) {
                return !$period->isSunday();
            })
            ->toArray();

        foreach ($period as $i => $date) { // get only stringdate
            $period[$i] = $date->toDateString();
        }

        $periodDate = array_reverse($period);

        // $histories = $presensi->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        $hadir = $presensi->whereYear('presence_date', $thisYear)
            ->whereMonth('presence_date', $currentMonth)->get();

        // $telat = $presensi->whereYear('presence_date', $thisYear)
        //     ->whereMonth('presence_date', $currentMonth)
        //     ->where('entry_time', '>', '08:00')
        //     ->get();

        $izin = Izin::selectRaw('title, count(*) as total')
            ->where('user_id', $user_id)
            ->whereYear('permission_date', $thisYear)
            ->whereMonth('permission_date', $currentMonth)
            ->where('title', 'Izin')
            ->where('is_accepted', 1)
            ->groupBy('title')
            ->pluck('total', 'title')->first();

        $sakit = Izin::selectRaw('title, count(*) as total')
            ->where('user_id', $user_id)
            ->whereYear('permission_date', $thisYear)
            ->whereMonth('permission_date', $currentMonth)
            ->where('title', 'Sakit')
            ->where('is_accepted', 1)
            ->groupBy('title')
            ->pluck('total', 'title')->first();

        return view('frontend.dashboard', [
            'title'         => 'Dashboard',
            'histories'     => $histories,
            'jmlHadir'      => $hadir->count(),
            // 'jmlTelat'      => $telat->count(),
            'jmlIzin'       => $izin,
            'jmlSakit'      => $sakit,
            'periodDate'    => $periodDate,
        ]);
    }
}
