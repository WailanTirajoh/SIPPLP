<?php

namespace App\Repositories;

use App\Models\cabor;

class CaborRepository
{
    public static function store($data)
    {
        $cabor = new cabor;
        $cabor->nama = $data->nama;
        $cabor->save();

        return $cabor;
    }

    public static function show($request)
    {
        $cabors = cabor::orderBy('nama', 'asc');

        if (!empty($request->search)) {
            // Ini nanti dirombak user_idnya pas internet jadi
            $cabors = $cabors->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        $cabors = $cabors->paginate(10, ['*'], 'cabors');
        $cabors->appends($request->all());

        return $cabors;
    }

    public static function update($request, cabor $cabor)
    {
        $cabor->nama = $request->nama;
        $cabor->save();

        return $cabor;
    }

    // Detail nanti dirombak pada saat ada internet
    // public function detail(cabor $cabor, $request)
    // {
    //     // $users = User::whereIn('role', ['Super', 'Admin'])->orderBy('id', 'DESC');
    //     $cabor = cabor::with('pplp')->where('id', $cabor->id)->first();
    //     // $cabor = cabor::join('pplps','pplps.cabor_id','cabors.id')->where('cabors.id', $cabor->id)->get();
    //     if (!empty($request->dari)) {
    //         // $users = $users->where('email', 'LIKE', '%' . $request->qu . '%');
    //     }

    //     // $users = $users->paginate(5, ['*'], 'users');
    //     // $users->appends($request->all());

    //     return $cabor;
    // }


}
