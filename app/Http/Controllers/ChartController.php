<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\cabor;
use App\Models\pertandingan;
use App\Repositories\ChartRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //
    public function getTotalAtletPerCabor(Request $request)
    {
        // dd($request->tahun);
        $array = cabor::orderBy('nama')->pluck('nama');
        $arrayId = cabor::orderBy('nama')->pluck('id');

        $banyak = [];
        for ($i = 0; $i < count($array); $i++) {
            array_push($banyak, ChartRepository::banyakAtletPerCabor($arrayId[$i], $request->tahun));
        }
        // dd($banyak);
        $max_no = max($banyak);
        $max = round(($max_no + 10 / 2) / 10) * 10;

        $totalPriaWanita = array(
            'jenis_kelamin' => $array,
            'banyak' => $banyak,
            'max' => $max
        );

        return $totalPriaWanita;
    }

    public function getCabor($index, Request $request)
    {
        // dd($index);
        $waktu = Carbon::parse($request->tahun . '-01-01');
        $dari = $waktu->format('Y-m-d');
        $sampai = $waktu->addYear()->format('Y-m-d');

        $arrayId = cabor::orderBy('nama')->pluck('id');
        $cabor = $arrayId[$index];

        return redirect()->route('cabor.show', ['cabor' => $cabor, 'dari' => $dari, 'sampai' => $sampai]);
    }

    //
    public function getPertandinganPerBulan(cabor $cabor)
    {
        $bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $array = [];
        $increment = [];

        for ($i = 1; $i <= count($bulan); $i++) {
            array_push($array, $this->pertandingan($cabor, $i));
            array_push($increment, $i);
        }

        $max_no = max($array);
        $max = round(($max_no + 10 / 2) / 10) * 10;

        $pertandinganPerBulan = array(
            'bulan' => $bulan,
            'banyak' => $array,
            'max' => $max
        );

        return $pertandinganPerBulan;
    }

    public function pertandingan(cabor $cabor, $bulan)
    {
        $waktu = Carbon::parse(Helper::thisYear() . '-' . $bulan . '-01');

        $pertandingan = pertandingan::where([['tanggal_mulai', '<=', $waktu->format('Y-m-d')], ['tanggal_selesai', '>=', $waktu->addMonth(1)->format('Y-m-d')], ['cabor_id', $cabor->id]])
            ->orWhere([['tanggal_mulai', '>=', $waktu->format('Y-m-d')], ['tanggal_mulai', '<=', $waktu->addMonth(1)->format('Y-m-d')], ['cabor_id', $cabor->id]])
            ->orWhere([['tanggal_selesai', '>=', $waktu->format('Y-m-d')], ['tanggal_selesai', '<=', $waktu->addMonth(1)->format('Y-m-d')], ['cabor_id', $cabor->id]])
            ->count();

        return $pertandingan;
    }
}
