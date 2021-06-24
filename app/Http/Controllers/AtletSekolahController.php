<?php

namespace App\Http\Controllers;

use App\Models\atlet;
use App\Models\sekolah;
use App\Repositories\AtletRepository;
use App\Repositories\SekolahRepository;
use Illuminate\Http\Request;

class AtletSekolahController extends Controller
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
    public function create(atlet $atlet)
    {
        $sekolahs = sekolah::all();
        return view('atlet.sekolah.create', compact('atlet', 'sekolahs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, atlet $atlet)
    {
        AtletRepository::storeAtlitToSekolah($request, $atlet);
        return redirect()->route('atlet.show',['atlet'=>$atlet->id])->with('success', 'Data sekolah berhasil ditambahkan');
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
    public function edit(atlet $atlet, sekolah $sekolah)
    {
        $pivot = $atlet->sekolahs()->get();
        // dd($pivot->where('id', $sekolah->id));
        $sekolahs = sekolah::all();
        return view('atlet.sekolah.edit', compact('atlet', 'sekolahs', 'sekolah'));
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
    public function destroy(atlet $atlet, Request $request)
    {
        AtletRepository::deleteAtlitFromSekolah($request, $atlet);
        return redirect()->route('atlet.show',['atlet'=>$atlet->id])->with('success', 'Data sekolah berhasil dihapus');
    }
}
