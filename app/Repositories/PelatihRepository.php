<?php

namespace App\Repositories;

use App\Models\pelatih;

class PelatihRepository
{
    public static function store($data, $user)
    {
        $pelatih = new pelatih;
        $pelatih->tempat_lahir = $data->tempat_lahir;
        $pelatih->tanggal_lahir = $data->tanggal_lahir;
        $pelatih->jenis_kelamin = $data->jenis_kelamin;
        $pelatih->agama = $data->agama;
        $pelatih->user_id = $user->id;
        $pelatih->save();

        return $pelatih;
    }
}
