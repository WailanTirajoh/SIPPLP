<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sertifikasi extends Model
{
    use HasFactory;

    public function pelatih()
    {
        return $this->hasMany(pelatih::class);
    }
}
