@extends('template.master')

@section('title', 'Detail Pertandingan')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>
                    Arsip {{ $pertandingan->nama }}
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-1">
                        <div class="d-grid gap-2 d-md-block float-end">
                            <a href="{{ route('arsippertandingan.create', ['pertandingan' => $pertandingan->id]) }}"
                                class="btn btn-sm shadow-sm myBtn border rounded" data-bs-toggle="tooltip"
                                data-bs-placement="right" title="Tambah Arsip">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @forelse ($pertandingan->AripPertandingans as $ArsipPertandingan)
                                        <div class="col-lg-4">
                                            <img src="{{ $ArsipPertandingan->getImage() }}" class="w-100 rounded" alt="">
                                            <p class="text-center">
                                                {{ $ArsipPertandingan->judul }}
                                            </p>
                                        </div>
                                    @empty
                                    <p class="text-center">
                                        Tidak ada arsip
                                    </p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
