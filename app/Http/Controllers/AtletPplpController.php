<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAtletPplpRequest;
use App\Models\atlet;
use App\Models\cabor;
use App\Models\pplp;
use App\Repositories\PplpRepository;
use Illuminate\Http\Request;

class AtletPplpController extends Controller
{
    public function create(atlet $atlet)
    {
        $cabors = cabor::all();
        return view('atlet.pplp.create', compact('atlet', 'cabors'));
    }

    public function store(StoreAtletPplpRequest $request, atlet $atlet)
    {
        $pplp = PplpRepository::store($request, $atlet);
        return redirect()->route('atlet.show',['atlet'=>$atlet->id])->with('success', $atlet->user->name.' berhasil ditambahkan ke pplp cabang olahraga '.$pplp->cabor->nama);
    }

    public function show($id)
    {
        //
    }

    public function edit(atlet $atlet, pplp $pplp)
    {
        $cabors = cabor::all();
        return view('atlet.pplp.edit', compact('cabors', 'atlet', 'pplp'));
    }

    public function update(StoreAtletPplpRequest $request, atlet $atlet, pplp $pplp)
    {
        $pplp = PplpRepository::update($request, $atlet, $pplp);
        return redirect()->route('atlet.show', ['atlet' => $atlet->id])->with('success', 'Data PPLP '. $atlet->user->name. ' berhasil diubah');
    }

    public function destroy(atlet $atlet, pplp $pplp)
    {
        $pplp->delete();
        return redirect()->route('atlet.show',['atlet'=>$atlet->id])->with('success','Data pplp berhasil dihapus!');
    }
}
