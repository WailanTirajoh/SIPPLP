<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSekolahRequest;
use App\Models\cabor;
use App\Models\sekolah;
use App\Repositories\SekolahRepository;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index(Request $request)
    {
        $sekolahs = SekolahRepository::show($request);
        return view('sekolah.index', compact('sekolahs'));
    }

    public function create()
    {
        return view('sekolah.create');
    }

    public function store(StoreSekolahRequest $request)
    {
        $sekolah = SekolahRepository::store($request);
        return redirect()->route('sekolah.index')->with('success','Data '. $sekolah->nama .' berhasil ditambahkan');
    }

    public function show(sekolah $sekolah, Request $request)
    {
        $cabors = cabor::all();

        $atlets = $sekolah->atlets();
        if(!empty($request->dari) || !empty($request->sampai)) {
            if(!empty($request->dari) && !empty($request->sampai)) {
                $atlets = $atlets->where([['tahun_mulai', '<=', $request->dari], ['tahun_selesai', '>=', $request->sampai],['sekolah_id',$sekolah->id]])
                ->orWhere([['tahun_mulai', '>=', $request->dari], ['tahun_mulai', '<=', $request->sampai],['sekolah_id',$sekolah->id]])
                ->orWhere([['tahun_selesai', '>=', $request->dari], ['tahun_selesai', '<=', $request->sampai],['sekolah_id',$sekolah->id]])
                // Ini untuk yang tahun selesainya NULL (Masih aktif di PPLP)
                ->orWhere([['tahun_mulai', '<=', $request->dari], ['tahun_selesai', NULL], ['sekolah_id', $sekolah->id]]);
            } else {
                return redirect()->back()->with('failed','Dari dan Sampai harus diisi!');
            }
        }

        $atlets = $atlets->orderBy('tahun_mulai', 'DESC')->get();
        return view('sekolah.show', compact('sekolah', 'cabors', 'atlets'));
    }

    public function edit(sekolah $sekolah)
    {
        return view('sekolah.edit', compact('sekolah'));
    }

    public function update(Request $request, sekolah $sekolah)
    {
        $sekolah = SekolahRepository::update($request, $sekolah);
        return redirect()->route('sekolah.index')->with('success','Data sekolah berhasil diupdate');
    }

    public function destroy(sekolah $sekolah)
    {
        try {
            $sekolah->delete();
            return redirect()->route('sekolah.index')->with('success', 'Sekolah ' . $sekolah->nama . ' berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('sekolah.index')->with('failed', 'Sekolah ' . $sekolah->nama . ' gagal dihapus! Error Code:' . $e->errorInfo[1]);;
        }
    }
}
