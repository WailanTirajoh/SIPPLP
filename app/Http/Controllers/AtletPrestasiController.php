<?php

namespace App\Http\Controllers;

use App\Models\atlet;
use App\Repositories\PrestasiRepository;
use Illuminate\Http\Request;

class AtletPrestasiController extends Controller
{
    public function index()
    {
        //
    }

    public function create(atlet $atlet)
    {
        return view('atlet.prestasi.create', compact('atlet'));
    }

    public function store(atlet $atlet, Request $request)
    {
        $prestasi = PrestasiRepository::store($request);
        PrestasiRepository::storeAtlitToPrestasi($atlet,$prestasi);
        return redirect()->route('atlet.show', ['atlet' => $atlet->id])->with('success','Prestasi berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(atlet $atlet, $prestasi)
    {
        $atlet->prestasis()->detach($prestasi);
        return redirect()->route('atlet.show', compact('atlet'))->with('success', 'atlet berhasil dihapus dari prestasi');
    }
}
