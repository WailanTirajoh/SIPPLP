@extends('template.master')
@section('title', 'Tambah Fisik Atlet')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Tambah Prestasi Atlet
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{route('prestasi.store')}}">
                            @csrf
                            <div class="col-md-12">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                    name="judul" value="{{ old('judul') }}">
                                @error('judul')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                    name="keterangan" value="{{ old('keterangan') }}">
                                @error('keterangan')
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
