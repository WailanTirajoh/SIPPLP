<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipPertandingan extends Model
{
    use HasFactory;

    public function pertandingan()
    {
        return $this->belongsTo(pertandingan::class);
    }

    public function getImage()
    {
        return asset('img/pertandingan/'.$this->pertandingan->cabor->nama.'/'.$this->url);
    }
}
