<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAtletFisikRequest;
use App\Models\atlet;
use App\Models\fisik;
use App\Repositories\FisikRepository;
use Illuminate\Http\Request;

class FisikController extends Controller
{
    private $fisikRepository;
    public function __construct(FisikRepository $fisikRepository)
    {
        $this->fisikRepository = $fisikRepository;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(fisik $fisik)
    {
        //
    }

    public function edit(fisik $fisik)
    {
        //
    }

    public function update(Request $request, fisik $fisik)
    {
        //
    }

    public function destroy(fisik $fisik)
    {
        //
    }


}
