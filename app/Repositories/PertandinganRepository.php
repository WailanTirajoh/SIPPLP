<?php

namespace App\Repositories;

use App\Models\pertandingan;

class PertandinganRepository
{
    public static function store($data, $cabor)
    {
        $pertandingan = new pertandingan;
        $pertandingan->nama = $data->nama;
        $pertandingan->tanggal_mulai = $data->tanggal_mulai;
        $pertandingan->tanggal_selesai = $data->tanggal_selesai;
        $pertandingan->cabor_id = $cabor->id;
        $pertandingan->hasil = $data->hasil;
        $pertandingan->save();

        return $pertandingan;
    }
}
