<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaborRequest;
use App\Models\cabor;
use App\Repositories\CaborRepository;
use Illuminate\Http\Request;

class CaborController extends Controller
{
    public function index(Request $request)
    {
        $cabors = CaborRepository::show($request);
        return view('cabor.index', compact('cabors'));
    }

    public function create()
    {
        return view('cabor.create');
    }

    public function store(StoreCaborRequest $request)
    {
        $cabor = CaborRepository::store($request);
        return redirect()->route('cabor.index')->with('success','Data '. $cabor->nama .' berhasil ditambahkan');
    }

    public function show(cabor $cabor, Request $request)
    {
        $pplps = $cabor->pplps();
        $pertandingans = $cabor->pertandingans();
        $tahuns = $cabor->tahuns();

        if(!empty($request->dari) || !empty($request->sampai)) {
            if(!empty($request->dari) && !empty($request->sampai)) {
                $pplps = $pplps->where([['tahun_mulai', '<=', $request->dari], ['tahun_selesai', '>=', $request->sampai],['cabor_id',$cabor->id]])
                ->orWhere([['tahun_mulai', '>=', $request->dari], ['tahun_mulai', '<=', $request->sampai],['cabor_id',$cabor->id]])
                ->orWhere([['tahun_selesai', '>=', $request->dari], ['tahun_selesai', '<=', $request->sampai],['cabor_id',$cabor->id]])
                ->orWhere([['tahun_mulai', '<=', $request->dari], ['tahun_selesai', NULL], ['cabor_id', $cabor->id]]);

                $tahuns = $tahuns->where([['tahun_mulai', '<=', $request->dari], ['tahun_selesai', '>=', $request->sampai],['cabor_id',$cabor->id]])
                ->orWhere([['tahun_mulai', '>=', $request->dari], ['tahun_mulai', '<=', $request->sampai],['cabor_id',$cabor->id]])
                ->orWhere([['tahun_selesai', '>=', $request->dari], ['tahun_selesai', '<=', $request->sampai],['cabor_id',$cabor->id]])
                // Ini untuk yang tahun selesainya NULL (Masih aktif di PPLP)
                ->orWhere([['tahun_mulai', '<=', $request->dari], ['tahun_selesai', NULL], ['cabor_id', $cabor->id]]);

                $pertandingans = $pertandingans->where([['tanggal_mulai', '<=', $request->dari], ['tanggal_selesai', '>=', $request->sampai],['cabor_id',$cabor->id]])
                ->orWhere([['tanggal_mulai', '>=', $request->dari], ['tanggal_mulai', '<=', $request->sampai],['cabor_id',$cabor->id]])
                ->orWhere([['tanggal_selesai', '>=', $request->dari], ['tanggal_selesai', '<=', $request->sampai],['cabor_id',$cabor->id]]);
            } else {
                return redirect()->back()->with('failed','Dari dan Sampai harus diisi!');
            }
        }

        $pplps = $pplps->orderBy('tahun_mulai', 'DESC')->get();
        $pertandingans = $pertandingans->orderBy('tanggal_selesai', 'DESC')->get();
        $tahuns = $tahuns->orderBy('tahun_selesai', 'DESC')->get();
        // dd($pertandingans);
        return view('cabor.show', compact('cabor', 'pplps','pertandingans', 'tahuns'));
    }

    public function edit(cabor $cabor)
    {
        return view('cabor.edit', compact('cabor'));
    }

    public function update(Request $request, cabor $cabor)
    {
        $cabor = CaborRepository::update($request, $cabor);
        return redirect()->route('cabor.index')->with('success','Data cabor berhasil diupdate');
    }

    public function destroy(cabor $cabor)
    {
        try {
            $cabor->delete();
            return redirect()->route('cabor.index')->with('success', 'cabor ' . $cabor->nama . ' berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('cabor.index')->with('failed', 'cabor ' . $cabor->nama . ' gagal dihapus! Error Code:' . $e->errorInfo[1]);;
        }
    }
}
