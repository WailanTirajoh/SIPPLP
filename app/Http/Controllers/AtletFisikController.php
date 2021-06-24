<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAtletFisikRequest;
use App\Models\atlet;
use App\Models\fisik;
use App\Repositories\FisikRepository;
use Illuminate\Http\Request;

class AtletFisikController extends Controller
{
    public function create(atlet $atlet)
    {
        return view('atlet.fisik.create', compact('atlet'));
    }

    public function store(atlet $atlet, StoreAtletFisikRequest $request)
    {
        FisikRepository::store($request,$atlet);
        return redirect()->route('atlet.show',['atlet'=>$atlet->id])->with('success','Data fisik berhasil ditambahkan!');
    }

    public function destroy(atlet $atlet, fisik $fisik)
    {
        $fisik->delete();
        return redirect()->route('atlet.show',['atlet'=>$atlet->id])->with('success','Data fisik berhasil dihapus!');
    }

    public function edit(atlet $atlet, fisik $fisik)
    {
        return view('atlet.fisik.edit',compact('fisik', 'atlet'));
    }

    public function update(atlet $atlet, fisik $fisik, StoreAtletFisikRequest $request)
    {
        FisikRepository::update($request, $fisik);
        return redirect()->route('atlet.show',['atlet'=>$atlet->id])->with('success','Data fisik berhasil diubah!');
    }
}
