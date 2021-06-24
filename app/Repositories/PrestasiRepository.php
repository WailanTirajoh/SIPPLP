<?php

namespace App\Repositories;

use App\Models\prestasi;

class PrestasiRepository
{
    public static function store($data)
    {
        $prestasi = new prestasi;
        $prestasi->judul = $data->judul;
        $prestasi->keterangan = $data->keterangan;
        $prestasi->save();

        return $prestasi;
    }

    public static function storeAtlitToPrestasi($atlet, $prestasi)
    {
        $atlet->prestasis()->attach($prestasi->id);
    }
}
