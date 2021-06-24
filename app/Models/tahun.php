<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tahun extends Model
{
    use HasFactory;

    public function cabor()
    {
        return $this->belongsTo(cabor::class);
    }

    public function pelatih()
    {
        return $this->belongsTo(pelatih::class);
    }
}
