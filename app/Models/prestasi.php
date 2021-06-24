<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prestasi extends Model
{
    use HasFactory;

    public function atlets()
    {
        return $this->belongsToMany(atlet::class);
    }

    public function arsips()
    {
        return $this->belongsToMany(arsip::class);
    }
}
