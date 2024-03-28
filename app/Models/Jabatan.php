<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function user()
    {
        return $this->hasMany(User::class);
    }

    function attendances()
    {
        return $this->belongsToMany(Attendance::class);
    }
}
