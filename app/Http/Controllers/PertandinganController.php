<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePertandinganFromCaborRequest;
use App\Models\cabor;
use App\Models\pertandingan;
use Illuminate\Http\Request;

class PertandinganController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('pertandingan.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(pertandingan $pertandingan)
    {
        return view('pertandingan.show', compact('pertandingan'));
    }

    public function edit(pertandingan $pertandingan)
    {
        //
    }

    public function update(Request $request, pertandingan $pertandingan)
    {
        //
    }

    public function destroy(pertandingan $pertandingan)
    {
        $pertandingan->delete();

        return redirect()->back()->with('success', 'Kejuaraan ' . $pertandingan->nama . ' berhasil dihapus!');
    }
}
