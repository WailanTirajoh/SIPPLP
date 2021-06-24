@extends('template.master')
@section('title', 'Tambah pertandingan')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border">
                <div class="card-header">
                    <h2>Tambah Pertandingan</h2>
                </div>
                <div class="card-body p-3">
                    <form class="row g-3" method="POST" action="{{ route('cabor.pertandingan.store') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                            @error('tanggal_mulai')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                            @error('tanggal_selesai')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" col-md-12">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin"
                                class="form-select @error('password') is-invalid @enderror">
                                <option selected disabled hidden>Choose...</option>
                                <option value="juara 1" @if (old('jenis_kelamin') == 'juara 1') selected @endif>juara 1</option>
                                <option value="juara 2" @if (old('jenis_kelamin') == 'juara 2') selected @endif>juara 2</option>
                                <option value="juara 3" @if (old('jenis_kelamin') == 'juara 3') selected @endif>juara 3</option>
                                <option value="harapan 1" @if (old('jenis_kelamin') == 'harapan 1') selected @endif>harapan 1</option>
                                <option value="harapan 2" @if (old('jenis_kelamin') == 'harapan 2') selected @endif>harapan 2</option>
                                <option value="harapan 3" @if (old('jenis_kelamin') == 'harapan 3') selected @endif>harapan 3</option>
                                <option value="tidak juara" @if (old('jenis_kelamin') == 'tidak juara') selected @endif>tidak juara</option>
                            </select>
                            @error('jenis_kelamin')
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
