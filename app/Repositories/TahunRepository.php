<?php

namespace App\Repositories;

use App\Models\tahun;

class TahunRepository
{
    public static function store($data, $pelatih)
    {
        $tahun = new tahun();
        $tahun->cabor_id = $data->cabor_id;
        $tahun->pelatih_id = $pelatih->id;
        $tahun->tahun_mulai = $data->tanggal_mulai;
        $tahun->tahun_selesai = $data->tanggal_selesai;
        $tahun->save();

        return $tahun;
    }

}
