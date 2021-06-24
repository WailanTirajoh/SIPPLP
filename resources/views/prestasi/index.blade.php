@extends('template.master')
@section('title', 'Prestasi')
@section('content')

    <div class="container">
        <div class="row mb-2">
            <div class="col-lg-12">
                <div class="d-grid gap-2 d-md-block">
                    <a href="{{ route('prestasi.create') }}" class="btn btn-sm shadow-sm myBtn border rounded"
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Tambah Prestasi">
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
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Judul</th>
                                            <th>Keterangan</th>
                                            <th>Kepada</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        @forelse ($prestasis as $prestasi)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $prestasi->judul }}</td>
                                                <td>{{ $prestasi->keterangan }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <ol>
                                                                @forelse ($prestasi->atlets as $atlet)
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('atlet.show', ['atlet' => $atlet->id]) }}">
                                                                            {{ $atlet->user->name }}
                                                                        </a>
                                                                    </li>
                                                                @empty
                                                                    <div class="text-center">
                                                                        -
                                                                    </div>
                                                                @endforelse
                                                            </ol>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <a href="{{ route('prestasi.atlet.create', ['prestasi' => $prestasi->id]) }}"
                                                                class="btn btn-sm shadow-sm myBtn border rounded w-100"
                                                                data-bs-toggle="tooltip" data-bs-placement="right"
                                                                title="Add Atlet">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    Tidak terdapat prestasi
                                                </td>
                                            </tr>
                                        @endforelse
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h5>
                            Prestasi
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
