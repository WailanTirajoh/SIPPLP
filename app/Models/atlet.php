<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class atlet extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class)->orderBy('name', 'desc');
    }

    public function sekolahs()
    {
        return $this->belongsToMany(sekolah::class)->withTimestamps()->withPivot('tahun_mulai', 'tahun_selesai', 'masuk_kelas')->orderByPivot('tahun_mulai', 'desc');
    }

    public function fisiks()
    {
        return $this->hasMany(fisik::class);
    }

    public function prestasis()
    {
        return $this->belongsToMany(prestasi::class);
    }

    public function pplps()
    {
        return $this->hasMany(pplp::class);
    }

    public function alamat()
    {
        return $this->hasOne(alamat::class);
    }

    public function umur()
    {
        return Carbon::parse($this->tanggal_lahir)->age . ' Tahun';
    }

    public function selesaiSekolah()
    {
        if (!empty($this->sekolahs()->tahun_selesai)) {
            return date('d M Y', strtotime($this->tahun_selesai));
        }

        return 'Masih Aktif';
    }

    public function sekolahPada($id)
    {
        $sekolahs = $this->sekolahs()->wherePivot('sekolah_id', $id)->get();
        return $sekolahs;
    }

    public function filterSekolah($waktu_mulai = null, $waktu_selesai = null)
    {
        $array_sekolah = array();

        if (!empty($this->sekolahs()->first())) {
            if (empty($waktu_mulai)) {
                array_push($array_sekolah, $this->sekolahs()->orderBy('tahun_mulai', 'desc')->first());
            } else {
                array_push($array_sekolah, $this->sekolahs()->where([['tahun_mulai', '<=', $waktu_selesai],])->orderBy('tahun_mulai', 'desc')->first());
            }
        }

        return $array_sekolah;
    }
}
