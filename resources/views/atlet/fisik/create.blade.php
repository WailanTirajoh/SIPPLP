@extends('template.master')
@section('title', 'Tambah Fisik Atlet')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Tambah Fisik Atlet
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{route('atlet.fisik.store',['atlet'=>$atlet->id])}}">
                            @csrf
                            <div class="col-md-12">
                                <label for="tinggi" class="form-label">Tinggi (CM) *</label>
                                <input type="number" class="form-control @error('tinggi') is-invalid @enderror" id="tinggi"
                                    name="tinggi" value="{{ old('tinggi') }}">
                                @error('tinggi')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="berat" class="form-label">Berat (KG) *</label>
                                <input type="number" class="form-control @error('berat') is-invalid @enderror" id="berat"
                                    name="berat" value="{{ old('berat') }}">
                                @error('berat')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="tahun_ambil_data" class="form-label">Tahun Pengambilan Data *</label>
                                <input type="date" class="form-control @error('tahun_ambil_data') is-invalid @enderror" id="tahun_ambil_data"
                                    name="tahun_ambil_data" value="{{ old('tahun_ambil_data') }}">
                                @error('tahun_ambil_data')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-light shadow-sm border float-end">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
