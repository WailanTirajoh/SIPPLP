<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelatih extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tahuns()
    {
        return $this->hasMany(tahun::class);
    }

    public function sertifikasis()
    {
        return $this->hasMany(sertifikasi::class);
    }

    public function umur()
    {
        return Carbon::parse($this->tanggal_lahir)->age . ' Tahun';
    }
}
