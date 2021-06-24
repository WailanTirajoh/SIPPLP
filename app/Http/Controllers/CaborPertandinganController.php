<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePertandinganFromCaborRequest;
use App\Models\cabor;
use App\Repositories\PertandinganRepository;

class CaborPertandinganController extends Controller
{
    public function create(cabor $cabor)
    {
        return view('cabor.pertandingan.create', compact('cabor'));
    }

    public function store (StorePertandinganFromCaborRequest $request,cabor $cabor)
    {
        PertandinganRepository::store($request, $cabor);
        return redirect()->route('cabor.show',['cabor'=>$cabor->id]);
    }
}
