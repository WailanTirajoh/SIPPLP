<?php

namespace App\Http\Controllers;

use App\Models\atlet;
use App\Models\prestasi;
use App\Repositories\PrestasiRepository;
use Illuminate\Http\Request;

class PrestasiAtletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(prestasi $prestasi)
    {
        $atlets = atlet::whereNotIn('id',$prestasi->atlets->pluck('id'))->get();
        return view('prestasi.atlet.create', compact('atlets', 'prestasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(prestasi $prestasi, Request $request)
    {
        // PrestasiRepository::storeAtlitToPrestasi($request,)
        $prestasi->atlets()->attach($request->atlet_id);
        return redirect()->route('prestasi.index')->with('success', 'Atlet berhasil ditambahkan ke prestasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
