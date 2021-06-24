<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArsipPertandinganRequest;
use App\Models\ArsipPertandingan;
use App\Models\pertandingan;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

class ArsipPertandinganController extends Controller
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
    public function create(pertandingan $pertandingan)
    {
        return view('arsippertandingan.create', compact('pertandingan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArsipPertandinganRequest $request, pertandingan $pertandingan)
    {
        // dd($pertandingan);
        // dd($request->all());
        $path = 'img/pertandingan/'.$pertandingan->cabor->nama.'/';
        $file = $request->file('media');
        $image = ImageRepository::uploadImage($path, $file);

        $arsip = new ArsipPertandingan;
        $arsip->judul = $request->judul;
        $arsip->type_media = 'Gambar'; //nanti ganti berdasarka extension dari file
        $arsip->url = $image;
        $arsip->pertandingan_id = $pertandingan->id;
        $arsip->save();

        return redirect()->route('pertandingan.show', ['pertandingan'=>$pertandingan]);
        // ArsipPertandingan::create('')

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArsipPertandingan  $arsipPertandingan
     * @return \Illuminate\Http\Response
     */
    public function show(ArsipPertandingan $arsipPertandingan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArsipPertandingan  $arsipPertandingan
     * @return \Illuminate\Http\Response
     */
    public function edit(ArsipPertandingan $arsipPertandingan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArsipPertandingan  $arsipPertandingan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArsipPertandingan $arsipPertandingan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArsipPertandingan  $arsipPertandingan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArsipPertandingan $arsipPertandingan)
    {
        //
    }
}
