@extends('template.master')
@section('title', 'Tambah Sekolah')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border">
                <div class="card-header">
                    <h2>Ubah Sekolah</h2>
                </div>
                <div class="card-body p-3">
                    <form class="row g-3" method="POST" action="{{ route('sekolah.update', ['sekolah'=>$sekolah->id]) }}">
                        @method('PUT')
                        @csrf
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ $sekolah->nama }}">
                            @error('nama')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" col-md-12">
                            <label for="jenjang" class="form-label">Jenjang</label>
                            <select id="jenjang" name="jenjang" class="form-select @error('password') is-invalid @enderror">
                                <option selected disabled hidden>Choose...</option>
                                <option value="SD" @if ($sekolah->jenjang == 'SD') selected @endif>SD</option>
                                <option value="SMP" @if ($sekolah->jenjang == 'SMP') selected @endif>SMP</option>
                                <option value="SMA" @if ($sekolah->jenjang == 'SMA') selected @endif>SMA</option>
                                <option value="SMK" @if ($sekolah->jenjang == 'SMK') selected @endif>SMK</option>
                                <option value="Universitas" @if ($sekolah->jenjang == 'Universitas') selected @endif>Universitas</option>
                            </select>
                            @error('jenjang')
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

@endsection
