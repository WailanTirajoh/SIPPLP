<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pertandingan extends Model
{
    use HasFactory;
    public function cabor()
    {
        return $this->belongsTo(cabor::class);
    }

    public function AripPertandingans()
    {
        return $this->hasMany(ArsipPertandingan::class);
    }
}
