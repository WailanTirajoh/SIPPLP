<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cabor extends Model
{
    use HasFactory;

    public function pplps()
    {
        return $this->hasMany(pplp::class);
    }

    public function tahuns()
    {
        return $this->hasMany(tahun::class);
    }

    public function pertandingans()
    {
        return $this->hasMany(pertandingan::class);
    }

    public function pertandinganPada($from, $to)
    {
        // dd($from);
        if ($to == null) {
            $to = Carbon::now();
        }

        $pertandingans = $this->pertandingans()
            ->where([['tanggal_mulai', '>=', $from], ['tanggal_selesai', '<=', $to], ['cabor_id', $this->id]])
            // ->orderBy('tanggal_mulai', 'desc')
            ->get();
        // dd($pertandingans);
        return $pertandingans;
    }

    public function atletPadaSekolah(sekolah $sekolah, $dari = null, $sampai = null)
    {
        $atlets = $this->join('pplps as p', 'p.cabor_id', 'cabors.id')
            ->join('atlets as a', 'a.id', 'p.atlet_id')
            ->join('atlet_sekolah as as', 'as.atlet_id', 'a.id')
            ->where([['as.sekolah_id', $sekolah->id], ['p.cabor_id', $this->id]]);

        if (!empty($dari) || !empty($sampai)) {
            if (!empty($dari) && !empty($sampai)) {
                $atlets = $atlets->where([['as.tahun_mulai', '<=', $dari], ['as.tahun_selesai', '>=', $sampai], ['as.sekolah_id', $sekolah->id], ['p.cabor_id', $this->id]])
                    ->orWhere([['as.tahun_mulai', '>=', $dari], ['as.tahun_mulai', '<=', $sampai], ['as.sekolah_id', $sekolah->id], ['p.cabor_id', $this->id]])
                    ->orWhere([['as.tahun_selesai', '>=', $dari], ['as.tahun_selesai', '<=', $sampai], ['as.sekolah_id', $sekolah->id], ['p.cabor_id', $this->id]])
                    // Ini untuk yang tahun selesainya NULL (Masih aktif di PPLP)
                    ->orWhere([['as.tahun_mulai', '<=', $dari], ['as.tahun_selesai', NULL], ['as.sekolah_id', $sekolah->id], ['p.cabor_id', $this->id]]);
            } else {
                return redirect()->back()->with('failed', 'Dari dan Sampai harus diisi!');
            }
        } else {
            $atlets = $atlets->where([['as.sekolah_id', $sekolah->id], ['p.cabor_id', $this->id]]);
        }
        // dd($atlet);
        return $atlets;
    }
}
