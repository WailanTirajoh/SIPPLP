<?php

namespace App\Repositories;

use App\Models\atlet;
use Illuminate\Support\Carbon;

class AtletRepository
{
    public static function store($data)
    {
        $user = UserRepository::storeAtlet($data);
        $atlet = AtletRepository::storeAtlet($data, $user);
        FisikRepository::store($data, $atlet);
        AlamatRepository::store($data, $atlet);
        PplpRepository::store($data, $atlet);
        AtletRepository::storeAtlitToSekolah($data, $atlet);

        return $atlet;
    }

    public static function storeAtlet($data, $user)
    {
        $atlet = new atlet;
        $atlet->tempat_lahir = $data->tempat_lahir;
        $atlet->tanggal_lahir = $data->tanggal_lahir;
        $atlet->jenis_kelamin = $data->jenis_kelamin;
        $atlet->agama = $data->agama;
        $atlet->user_id = $user->id;
        $atlet->save();

        return $atlet;
    }

    public static function updateAtlet($data, atlet $atlet)
    {
        // dd($data->tempat_lahir);
        $atlet->tempat_lahir = $data->tempat_lahir;
        $atlet->tanggal_lahir = $data->tanggal_lahir;
        $atlet->jenis_kelamin = $data->jenis_kelamin;
        $atlet->agama = $data->agama;
        $atlet->save();

        return $atlet;
    }

    public static function storeAtlitToSekolah($data, $atlet)
    {
        $atlet->sekolahs()->attach($data->sekolah_id, [
            'tahun_mulai' => $data->tanggal_mulai_sekolah,
            'tahun_selesai' => $data->tanggal_selesai_sekolah,
            'masuk_kelas' => $data->masuk_kelas,
        ]);
    }

    public static function deleteAtlitFromSekolah($data, $atlet)
    {
        $atlet->sekolahs()->detach($data->sekolah_id, [
            'tahun_mulai' => $data->tanggal_mulai_sekolah,
            'tahun_selesai' => $data->tanggal_selesai_sekolah,
            'masuk_kelas' => $data->masuk_kelas,
        ]);
    }

    public static function updateAtlitFromSekolah($data, $atlet)
    {
        $atlet->sekolahs()->sync([$data->sekolah_id, [
            'tahun_mulai' => $data->tanggal_mulai_sekolah,
            'tahun_selesai' => $data->tanggal_selesai_sekolah,
            'masuk_kelas' => $data->masuk_kelas,
        ]]);
    }

    public static function show($request)
    {
        $atlets = atlet::join('pplps as p', 'p.atlet_id', '=', 'atlets.id')
            ->join('users as u', 'u.id', 'atlets.user_id')
            ->join('cabors as c', 'c.id', '=', 'p.cabor_id');

        if (!empty($request->cabor)) {
            $atlets = $atlets
                ->where('c.nama', $request->cabor);
        }
        if (!empty($request->dari) && !empty($request->sampai)) {
            // dd($request->dari);
            // if($request->dari == '2021-01-01') {
                // dd('tes');
            // }
            if (!empty($request->cabor)) {
                $atlets = $atlets->where([['p.tahun_mulai', '<=', $request->dari], ['p.tahun_selesai', '>=', $request->sampai], ['u.name', 'LIKE', '%' . $request->search . '%'], ['c.nama', $request->cabor]])
                    ->orWhere([['p.tahun_mulai', '>=', $request->dari], ['p.tahun_mulai', '<=', $request->sampai], ['u.name', 'LIKE', '%' . $request->search . '%'], ['c.nama', $request->cabor]])
                    ->orWhere([['p.tahun_selesai', '>=', $request->dari], ['p.tahun_selesai', '<=', $request->sampai], ['u.name', 'LIKE', '%' . $request->search . '%'], ['c.nama', $request->cabor]])
                    ->orWhere([['p.tahun_mulai', '<=', $request->dari], ['p.tahun_selesai', NULL], ['u.name', 'LIKE', '%' . $request->search . '%'], ['c.nama', $request->cabor]]);
            } else {
                $atlets = $atlets->where([['p.tahun_mulai', '<=', $request->dari], ['p.tahun_selesai', '>=', $request->sampai], ['u.name', 'LIKE', '%' . $request->search . '%']])
                    ->orWhere([['p.tahun_mulai', '>=', $request->dari], ['p.tahun_mulai', '<=', $request->sampai], ['u.name', 'LIKE', '%' . $request->search . '%']])
                    ->orWhere([['p.tahun_selesai', '>=', $request->dari], ['p.tahun_selesai', '<=', $request->sampai], ['u.name', 'LIKE', '%' . $request->search . '%']])
                    ->orWhere([['p.tahun_mulai', '<=', $request->dari], ['p.tahun_selesai', NULL], ['u.name', 'LIKE', '%' . $request->search . '%']]);
            }
        }

        $atlets = $atlets
            ->orderBy('c.nama', 'asc')
            ->orderBy('p.tahun_mulai', 'desc')
            ->orderBy('u.name', 'asc')
            ->select('atlets.*')
            ->with('user', 'fisiks', 'pplps', 'sekolahs');

        if (!empty($request->cabor)) {
            $atlets = $atlets
                ->where('c.nama', $request->cabor);
        }
        if (!empty($request->search)) {
            // Ini nanti dirombak user_idnya pas internet jadi
            $atlets = $atlets->where('u.name', 'LIKE', '%' . $request->search . '%');
        }

        $atlets = $atlets->paginate(10, ['*'], 'atlets');
        $atlets->appends($request->all());

        return $atlets;
    }
}
