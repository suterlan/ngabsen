<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;

        $histories = Presensi::where('user_id', $user_id)
            ->with('attendance')
            ->whereYear('presence_date', Carbon::now()->year)
            ->whereMonth('presence_date', Carbon::now()->month)
            ->orderBy('presence_date', 'desc')
            ->paginate(6);

        if ($request->filter_tahun && $request->filter_bulan) {
            $histories = Presensi::where('user_id', $user_id)
                ->whereYear('presence_date', $request->filter_tahun)
                ->whereMonth('presence_date', $request->filter_bulan)
                ->orderBy('presence_date', 'desc')
                ->paginate(10);
        }

        $startMonth = Carbon::now()->firstOfMonth()->toDateString();
        $endMonth = Carbon::now()->toDateString();
        // periode tanggal (satu bulan)
        $period = CarbonPeriod::create($startMonth, $endMonth)
            ->filter(function ($period) {
                return !$period->isSunday();
            })
            ->toArray();

        foreach ($period as $i => $date) { // get only stringdate
            $period[$i] = $date->toDateString();
        }

        $periodDate = array_reverse($period);

        return view('frontend.presensi.history', [
            'title'     => 'Riwayat Presensi',
            'histories' => $histories,
            'periodDate'    => $periodDate,
        ]);
    }
}
