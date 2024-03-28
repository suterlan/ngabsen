<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'limit_start_time',
        'end_time',
        'limit_end_time',
        'code',
    ];

    protected $appends = ['data'];

    protected function data(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $now = now();
                $startTime = Carbon::parse($this->start_time);
                $limitStartTime = Carbon::parse($this->limit_start_time);

                $endTime = Carbon::parse($this->end_time);
                $limitEndTime = Carbon::parse($this->limit_end_time);

                $isHolidayToday = Holiday::query()
                    ->where('holiday_date', now()->toDateString())
                    ->get();

                return (object) [
                    "start_time" => $this->start_time,
                    "limit_start_time" => $this->limit_start_time,
                    "end_time" => $this->end_time,
                    "limit_end_time" => $this->limit_end_time,
                    "now" => $now->format("H:i:s"),
                    "is_start" => $startTime <= $now && $limitStartTime >= $now,
                    "is_end" => $endTime <= $now && $limitEndTime >= $now,
                    'is_using_qrcode' => $this->code ? true : false,
                    'is_holiday_today' => $isHolidayToday->isNotEmpty()
                ];
            },
        );
    }

    public function scopeForCurrentUser($query, $userJabatanId)
    {
        $query->whereHas('jabatans', function ($query) use ($userJabatanId) {
            $query->where('jabatan_id', $userJabatanId);
        });
    }

    public function jabatans()
    {
        return $this->belongsToMany(Jabatan::class);
    }

    public function presences()
    {
        return $this->hasMany(Presensi::class);
    }

    // public function work_shifts()
    // {
    //     return $this->belongsToMany(WorkShift::class, 'attendance_scope');
    // }
}
