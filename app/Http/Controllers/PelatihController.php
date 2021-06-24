<?php

namespace App\Http\Controllers;

use App\Models\cabor;
use App\Models\pelatih;
use App\Repositories\AtletRepository;
use App\Repositories\PelatihRepository;
use App\Repositories\TahunRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class PelatihController extends Controller
{
    public function index(Request $request)
    {
        $pelatihs = pelatih::join('users as u', 'pelatihs.user_id', '=', 'u.id')->select('pelatihs.*');

        if (!empty($request->search)) {
            $pelatihs = $pelatihs->where('u.name', 'LIKE', '%' . $request->search . '%');
        }

        $pelatihs = $pelatihs->paginate(5);
        return view('pelatih.index', compact('pelatihs'));
    }

    public function create()
    {
        $cabors = cabor::all();
        return view('pelatih.create', compact('cabors'));
    }

    public function store(Request $request)
    {
        $user = UserRepository::storePelatih($request);
        $pelatih = PelatihRepository::store($request, $user);
        TahunRepository::store($request, $pelatih);

        return redirect()->route('pelatih.index')->with('success', 'Data pelatih berhasil ditambahkan!');
    }

    public function show(pelatih $pelatih)
    {
        return view('pelatih.show', compact('pelatih'));
    }

    public function edit(pelatih $pelatih)
    {
        //
    }

    public function update(Request $request, pelatih $pelatih)
    {
        //
    }

    public function destroy(pelatih $pelatih)
    {
        // dd($pelatih);
        $pelatih->delete();
        $pelatih->user->delete();

        return redirect()->route('pelatih.index')->with('success', 'Pelatih berhasil dihapus!');
    }
}
