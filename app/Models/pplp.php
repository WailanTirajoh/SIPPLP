<?php

namespace App\Models;

use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pplp extends Model
{
    use HasFactory;

    public function cabor()
    {
        return $this->belongsTo(cabor::class);
    }

    public function atlet()
    {
        return $this->belongsTo(atlet::class);
    }

    public function status($tahun = null)
    {
        empty($tahun) ? $tahun = Carbon::now() : $tahun;
        if (!empty($this->tahun_selesai) && $this->tahun_selesai <= $tahun) {
            return 'Alumni
            (' . $this->tahun_selesai . ')';
        }
        // if ((empty($this->tahun_selesai) || $this->tahun_selesai > Carbon::now()) || (!empty($tahun) && $this->tahun_selesai > $tahun)) {
            return 'Aktif';
        // }
        // return 'Tidak Aktif';
    }

    public function lama()
    {
        if (!empty($this->tahun_selesai)) {
            return Helper::dayToYearsMonthDay(sekolah::getDateDifference($this->tahun_mulai, $this->tahun_selesai));
        }

        return Helper::dayToYearsMonthDay(sekolah::getDateDifference($this->tahun_mulai, Carbon::now()));
    }
}
