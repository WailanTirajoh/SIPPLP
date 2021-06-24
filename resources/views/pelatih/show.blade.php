@extends('template.master')

@section('title', 'Profile Pelatih')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 d-flex">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Data Diri Pelatih
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="{{ $pelatih->user->getAvatar() }}" class="w-100 rounded" alt="...">
                            <div class="table-responsive mt-2">
                                <table style="white-space:nowrap" class="overflow-hidden">
                                    <tr>
                                        <td style="width: 125px">Nama</td>
                                        <td>: {{ $pelatih->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>: {{ $pelatih->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>TTL</td>
                                        <td>: {{ $pelatih->tempat_lahir }},
                                            {{ date('d M Y', strtotime($pelatih->tanggal_lahir)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Umur</td>
                                        <td>: {{ $pelatih->umur() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>: {{ $pelatih->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td>
                                        <td>: {{ $pelatih->agama }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
