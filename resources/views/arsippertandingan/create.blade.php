@extends('template.master')

@section('title', 'Tambah Arsip')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Tambah Arsip
            </div>
            <div class="card-body">
                <form class="row g-3" method="POST"
                    action="{{ route('arsippertandingan.store', ['pertandingan' => $pertandingan]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                            value="{{ old('judul') }}">
                        @error('judul')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="media" class="form-label">Video / Gambar</label>
                        <input type="file" class="form-control @error('media') is-invalid @enderror" id="media" name="media"
                            value="{{ old('media') }}">
                        @error('media')
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
@endsection
