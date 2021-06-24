<?php

namespace App\Repositories;

use App\Models\pplp;

class PplpRepository
{
    public static function store($data, $atlet)
    {
        $pplp = new pplp;
        $pplp->cabor_id = $data->cabor_id;
        $pplp->atlet_id = $atlet->id;
        $pplp->tahun_mulai = $data->tanggal_mulai_pplp;
        $pplp->tahun_selesai = $data->tanggal_selesai_pplp;
        $pplp->save();

        return $pplp;
    }

    public static function update($data, $atlet, $pplp)
    {
        $pplp->cabor_id = $data->cabor_id;
        $pplp->atlet_id = $atlet->id;
        $pplp->tahun_mulai = $data->tanggal_mulai_pplp;
        $pplp->tahun_selesai = $data->tanggal_selesai_pplp;
        $pplp->save();

        return $pplp;
    }
}
