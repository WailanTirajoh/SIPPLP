<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sekolah extends Model
{
    use HasFactory;

    public function atlets()
    {
        return $this->belongsToMany(atlet::class)->withPivot('tahun_mulai', 'tahun_selesai', 'masuk_kelas')->orderByPivot('tahun_mulai', 'desc');
    }

    public function status()
    {
        if (empty($this->pivot->tahun_selesai) || $this->pivot->tahun_selesai > Carbon::now()) {
            return 'Aktif';
        }

        return 'Tidak Aktif';
    }

    public function kelas($dari = null, $sampai = null)
    {
        // NOTE: NANTI UBAH LOGIC NAIK KELAS BERDASARKAN BULAN NAIK KELAS
        //          -SEKARANG MASIH MENGGUNAKAN +1 TAHUN
        // 13 Juli 2020 (Semester 1)
        // 4 Januari 2021 (Semester 2)
        // Sumber https://www.ruangguru.com/blog/kalender-pendidikan-tahun-ajaran-2020/2021
        $status = '';
        if (empty($dari)) {
            $waktu_akhir = !empty($this->pivot->tahun_selesai) ? $this->pivot->tahun_selesai : Carbon::now();
        } else {
            if ($this->pivot->tahun_selesai < $sampai && !empty($this->pivot->tahun_selesai)) {
                $waktu_akhir = !empty($this->pivot->tahun_selesai) ? $this->pivot->tahun_selesai : Carbon::now();
            } else {
                $waktu_akhir = $sampai;
            }
            if ($this->pivot->tahun_mulai > $sampai) {
                return 'Belum masuk';
            }
        }

        $year = floor($this->getDateDifference($this->pivot->tahun_mulai, $waktu_akhir) / 365);

        $kelas = $this->pivot->masuk_kelas + $year;

        // dd($kelas);

        if ($kelas > 3) {
            $kelas = 'Lulus';
        } else if ($kelas < 1) {
            $kelas = 'Belum';
        }

        $aktif = empty($this->pivot->tahun_selesai) ? $kelas . ' ' . $this->jenjang : $kelas . ' ' . $this->jenjang;
        return $aktif . ' ' . $status;
    }

    public static function getDateDifference($check_in, $check_out)
    {
        $check_in = strtotime($check_in);
        $check_out = strtotime($check_out);
        $date_difference = $check_out - $check_in;
        $date_difference = round($date_difference / (60 * 60 * 24));
        return $date_difference;
    }
}
