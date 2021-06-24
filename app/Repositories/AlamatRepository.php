<?php

namespace App\Repositories;

use App\Models\alamat;

class AlamatRepository
{
    public static function store($data, $atlet)
    {
        $alamat = new alamat;
        $alamat->alamat = $data->alamat;
        $alamat->rt_rw = $data->rt_rw;
        $alamat->kel_desa = $data->kel_desa;
        $alamat->kecamatan = $data->kecamatan;
        $alamat->atlet_id = $atlet->id;
        $alamat->save();

        return $alamat;
    }

    public static function update($data, $atlet, $alamat)
    {
        $alamat->alamat = $data->alamat;
        $alamat->rt_rw = $data->rt_rw;
        $alamat->kel_desa = $data->kel_desa;
        $alamat->kecamatan = $data->kecamatan;
        $alamat->atlet_id = $atlet->id;
        $alamat->save();

        return $alamat;
    }
}
