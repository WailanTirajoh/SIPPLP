<?php

namespace App\Repositories;

use App\Models\sekolah;

class SekolahRepository
{
    public static function store($data)
    {
        $sekolah = new sekolah;
        $sekolah->nama = $data->nama;
        $sekolah->jenjang = $data->jenjang;
        $sekolah->save();

        return $sekolah;
    }

    public static function show($request)
    {
        $sekolahs = sekolah::orderBy('id', 'DESC');

        if (!empty($request->search)) {
            // Ini nanti dirombak user_idnya pas internet jadi
            $sekolahs = $sekolahs->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        $sekolahs = $sekolahs->paginate(5, ['*'], 'sekolahs');
        $sekolahs->appends($request->all());

        return $sekolahs;
    }

    public static function update($request, sekolah $sekolah)
    {
        $sekolah->nama = $request->nama;
        $sekolah->jenjang = $request->jenjang;
        $sekolah->save();

        return $sekolah;
    }
}
