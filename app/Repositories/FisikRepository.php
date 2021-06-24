<?php

namespace App\Repositories;

use App\Models\fisik;

class FisikRepository
{
    public static function store($data, $atlet)
    {
        $fisik = new fisik;
        $fisik->tinggi = $data->tinggi;
        $fisik->berat = $data->berat;
        $fisik->tahun_ambil_data = $data->tahun_ambil_data;
        $fisik->atlet_id = $atlet->id;
        $fisik->save();

        return $fisik;
    }

    public static function update($data, $fisik)
    {
        $fisik->tinggi = $data->tinggi;
        $fisik->berat = $data->berat;
        $fisik->tahun_ambil_data = $data->tahun_ambil_data;
        $fisik->save();

        return $fisik;
    }

    // public function showSuper($request)
    // {
    //     $users = User::where('role','Super')->orderBy('id', 'DESC');

    //     if (!empty($request->qu)) {
    //         $users = $users->where('name', 'LIKE', '%' . $request->qu . '%');
    //     }

    //     $users = $users->paginate(5, ['*'], 'users');
    //     $users->appends($request->all());

    //     return $users;
    // }
}
