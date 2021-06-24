<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arsip extends Model
{
    use HasFactory;

    public function prestasi()
    {
        return $this->belongsTo(prestasi::class);
    }
}
