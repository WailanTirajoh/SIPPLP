<?php

namespace App\Http\Controllers;

use App\Models\prestasi;
use App\Repositories\PrestasiRepository;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = prestasi::all();
        return view('prestasi.index', compact('prestasis'));
    }

    public function create()
    {
        return view('prestasi.create');
    }

    public function store(Request $request)
    {
        PrestasiRepository::store($request);
        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil ditambahkan');
    }

    public function show(prestasi $prestasi)
    {
        //
    }

    public function edit(prestasi $prestasi)
    {
        //
    }

    public function update(Request $request, prestasi $prestasi)
    {
        //
    }

    public function destroy(prestasi $prestasi)
    {
        //
    }
}
