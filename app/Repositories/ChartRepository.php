<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\pplp;
use Carbon\Carbon;

class ChartRepository
{
    public static function banyakAtletPerCabor($cabor_id, $tahun = null)
    {
        empty($tahun) ? $tahun = Helper::thisYear() : $tahun = $tahun;

        $waktu = Carbon::parse($tahun . '-01-01');
        $dari = $waktu->format('Y/m/d');
        $sampai = $waktu->addYear()->format('Y/m/d');
        $totalAtlet = pplp::where([['tahun_mulai', '<=', $dari], ['tahun_selesai', '>=', $sampai], ['cabor_id', $cabor_id]])
            ->orWhere([['tahun_mulai', '>=', $dari], ['tahun_mulai', '<=', $sampai], ['cabor_id', $cabor_id]])
            ->orWhere([['tahun_selesai', '>=', $dari], ['tahun_selesai', '<=', $sampai], ['cabor_id', $cabor_id]])
            ->orWhere([['tahun_mulai', '<=', $dari], ['tahun_selesai', NULL], ['cabor_id', $cabor_id]])
            ->count();

        return $totalAtlet;
    }
}
