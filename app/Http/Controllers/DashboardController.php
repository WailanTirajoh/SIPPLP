<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\cabor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->tahun);
        if(!empty($request->tahun) && $request->tahun > Helper::thisYear()){
            return redirect()->back()->with('failed', 'Tahun tidak boleh lebih dari tahun sekarang!');
        }
        $tahun = !empty($request->tahun) ? $request->tahun : Helper::thisYear();
        $cabors = cabor::orderBy('nama')->get();
        return view('home', compact('cabors', 'tahun'));
    }
}
