<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\Izin;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public $data;

    public function index()
    {
        $attendances = Attendance::query()
            ->forCurrentUser(auth()->user()->jabatan_id)
            ->get()
            ->sortByDesc('data.is_end')
            ->sortByDesc('data.is_start');

        return view('frontend.presensi.index', [
            'title'             => 'Presensi',
            'attendances'       => $attendances
        ]);
    }

    public function show(Attendance $attendance)
    {
        // dd($attendance->data);
        $presences = Presensi::query()
            ->where('attendance_id', $attendance->id)
            ->where('presence_date', now()->toDateString())
            ->where('user_id', auth()->user()->id)
            ->get();

        $isHasEnterToday = $presences
            ->where('presence_date', now()->toDateString())
            ->isNotEmpty();

        $isTherePermission = Izin::query()
            ->where('permission_date', now()->toDateString())
            ->where('attendance_id', $attendance->id)
            ->where('user_id', auth()->user()->id)
            ->first();

        $data = [
            'is_has_enter_today' => $isHasEnterToday, // sudah absen masuk
            'is_not_out_yet' => $presences->where('out_time', null)->isNotEmpty(), // belum absen pulang
            'is_there_permission' => (bool) $isTherePermission,
            'is_permission_accepted' => $isTherePermission?->is_accepted ?? false
        ];

        $holiday = $attendance->data->is_holiday_today ? Holiday::query()
            ->where('holiday_date', now()->toDateString())
            ->first() : false;

        return view('frontend.presensi.show', [
            'title'         => 'Presensi',
            "attendance"    => $attendance,
            "data"          => $data,
            "holiday"       => $holiday,
        ]);
    }

    public function store(Request $request)
    {
        $attendance = Attendance::find($request->attendance_id);
        // dd($attendance->data);
        $validated = $request->validate([
            'location'   => 'required',
            'picture'    => 'required',
        ]);

        //lokasi kantor  -6.920715092599272, 107.61023226322612
        $locationOffice = ['latitude' => -6.920715092599272, 'longitude' => 107.61023226322612];
        // dd($locationOffice);

        list($lat, $lon) = explode(',', $validated['location']);
        $locationUser['latitude'] = $lat;
        $locationUser['longitude'] = $lon;
        // dd($locationUser);

        $distance = self::getDistanceBetweenPoints($locationOffice['latitude'], $locationOffice['longitude'], $locationUser['latitude'], $locationUser['longitude']);
        $radius = round($distance['meters']);
        // dd($radius);
        if ($radius > 10000) {
            return back()->with('failed', 'Anda berada diluar jangkauan untuk melakukan absen!');
        } else {
            $user_id = Auth::user()->id;
            $presence_date = date('Y-m-d');

            // explode atau bagi menjadi 2 bagian array dari picture yang masih di encode dengan base64
            $picturePart = explode(';base64', $validated['picture']);
            // decode picture yang telah dibagi 2 
            $picture = base64_decode($picturePart[1]);

            // cek presensi di database sesuai hari ini dan id user
            $presensi = Presensi::where('user_id', $user_id)
                ->where('attendance_id', $attendance->id)
                ->where('presence_date', $presence_date)
                ->first();

            $presensi ? $ket = '_entry' : $ket = '_out';

            // config upload picture
            $path = "presensi/ID" . $user_id . "/";
            $fileName = $user_id . '_' . $presence_date . $ket . '.png';
            $file = $path . $fileName;

            // jika presensi hari ini null (kosong di database) dan waktu absen sudah mulai, maka lakukan insert
            // jika tidak null (berarti ada) maka update
            if (is_null($presensi) && $attendance->data->is_start) {
                // untuk refresh if statement
                $this->data['is_has_enter_today'] = true;
                $this->data['is_not_out_yet'] = true;

                return Presensi::create([
                    'user_id'          => $user_id,
                    'attendance_id'    => $attendance->id,
                    'presence_date'    => $presence_date,
                    'entry_time'       => now()->toTimeString(),
                    'entry_foto'       => $file,
                    'entry_location'   => $validated['location'],
                ])
                    && Storage::put($file, $picture)
                    ? back()->with('success', 'Berhasil, anda sudah absen masuk hari ini!')
                    : back()->with('failed', 'Proses absen gagal!');
            } else {
                // jika absensi sudah jam pulang (is_end) maka (kebalikan)
                if (!$attendance->data->is_end) {
                    return false;
                } else {
                    // untuk refresh if statement
                    $this->data['is_not_out_yet'] = false;

                    return $presensi->update([
                        'out_time'      => now()->toTimeString(),
                        'out_foto'      => $file,
                        'out_location'  => $validated['location'],
                    ])
                        && Storage::put($file, $picture)
                        ? back()->with('success', 'Berhasil, anda sudah absen pulang hari ini!')
                        : back()->with('failed', 'Proses absen gagal!');
                }
            }
        }
    }

    /**
     * Calculates the distance between two points, given their 
     * latitude and longitude, and returns an array of values 
     * of the most common distance units
     *
     * @param  {coord} $lat1 Latitude of the first point
     * @param  {coord} $lon1 Longitude of the first point
     * @param  {coord} $lat2 Latitude of the second point
     * @param  {coord} $lon2 Longitude of the second point
     * @return {array}       Array of values in many distance units
     */
    private function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet  = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('miles', 'feet', 'yards', 'kilometers', 'meters');
    }
}
