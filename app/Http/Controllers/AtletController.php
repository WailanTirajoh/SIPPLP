<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAtletRequest;
use App\Http\Requests\UpdateAtletRequest;
use App\Models\atlet;
use App\Models\cabor;
use App\Models\sekolah;
use App\Repositories\AlamatRepository;
use App\Repositories\AtletRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AtletController extends Controller
{
    public function index(Request $request)
    {
        $atlets = AtletRepository::show($request);
        $cabors = cabor::all();

        if (!empty($request->dari) || !empty($request->sampai)) {
            if (empty($request->dari) && !empty($request->sampai)) {
                return redirect()->back()->with('failed', 'Dari dan Sampai harus diisi dua duanya!');
            } else if (!empty($request->dari) && empty($request->sampai)) {
                return redirect()->back()->with('failed', 'Dari dan Sampai harus diisi dua duanya!');
            }

            if($request->sampai < $request->dari) {
                return redirect()->back()->with('failed', 'Input salah! Sampai tidak boleh lebih kecil dari Dari');
            }
            $unAcitveAtlets = [];
        }
        return view('atlet.index', compact('atlets', 'cabors'));
    }

    public function create()
    {
        $sekolahs = sekolah::all();
        $cabors = cabor::all();
        return view('atlet.create', compact('sekolahs', 'cabors'));
    }

    public function store(StoreAtletRequest $request)
    {
        $atlet = AtletRepository::store($request);
        return redirect()->route('atlet.index')->with('success', 'Atlet ' . $atlet->user->name . ' berhasil ditambahkan');
    }

    public function show(atlet $atlet)
    {
        $atlet->setRelation('fisik', $atlet->fisiks());
        $atlet->setRelation('pplp', $atlet->pplps()->orderBy('tahun_mulai'));
        $atlet->setRelation('sekolah', $atlet->sekolahs()->orderByPivot('tahun_mulai', 'DESC'));

        return view('atlet.show', compact('atlet'));
    }

    public function edit(atlet $atlet)
    {
        return view('atlet.edit', compact('atlet'));
    }

    public function update(UpdateAtletRequest $request, atlet $atlet)
    {
        $request->validate([
            'email'  => 'required|email
            |unique:users,email,'.$atlet->user->id,
        ]);

        AtletRepository::updateAtlet($request, $atlet);
        UserRepository::update($request, $atlet->user);
        AlamatRepository::update($request, $atlet, $atlet->alamat);
        // dd('tes');
        return redirect()->route('atlet.show', compact('atlet'))->with('success','Data berhasil diupdate');
    }

    public function destroy(atlet $atlet)
    {
        try {
            $atlet->user->delete();
            $atlet->delete();
            return redirect()->route('atlet.index')->with('success', 'Atlet ' . $atlet->user->name . ' terhapus!');
        } catch (\Exception $e) {
            return redirect()->route('atlet.index')->with('failed', 'Atlet ' . $atlet->user->name . ' tidak dapat dihapus! Error Code:' . $e->errorInfo[1]);;
        }
    }
}
