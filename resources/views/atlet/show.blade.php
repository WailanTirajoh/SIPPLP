@extends('template.master')
@section('title', 'Data diri')
@section('content')
    <div class="container">
        <div class="card shadow">
            {{-- <div class="card-header">
                <h4>Data Diri Atlet</h4>
            </div> --}}
            <div class="card-body">
                <div class="row g-0 position-relative">
                    <div class="col-md-3 mb-md-0 p-md-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <img src="{{ $atlet->user->getAvatar() }}" class="w-100 rounded" alt="...">
                                <div class="table-responsive mt-2">
                                    <table style="white-space:nowrap" class="overflow-hidden">
                                        <tr>
                                            <td style="width: 125px">Nama</td>
                                            <td>: {{ $atlet->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>: {{ $atlet->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>TTL</td>
                                            <td>: {{ $atlet->tempat_lahir }},
                                                {{ date('d M Y', strtotime($atlet->tanggal_lahir)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Umur</td>
                                            <td>: {{ $atlet->umur() }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>: {{ $atlet->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>: {{ $atlet->agama }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr class="mt-3">
                            <div class="col-lg-12">
                                <h5>
                                    Alamat
                                </h5>
                                <div class="table-responsive">
                                    <table style="white-space:nowrap" class="overflow-hidden">
                                        <tr>
                                            <td>Alamat</td>
                                            <td>: {{ $atlet->alamat->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td>RT/RW</td>
                                            <td>: {{ $atlet->alamat->rt_rw }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kel/Desa</td>
                                            <td>: {{ $atlet->alamat->kel_desa }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td>: {{ $atlet->alamat->kecamatan }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            @if (in_array(auth()->user()->role, ['Super', 'Admin']))
                                <a href="{{ route('atlet.edit', ['atlet' => $atlet]) }}"
                                    class="btn btn-primary btn-sm mt-2">Ubah data diri</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9 p-4 ps-md-0">
                        <div class="col-md-12 px-md-4">
                            <div class="row mb-2">
                                <div class="col">
                                    <h4>Fisik</h4>
                                </div>
                                <div class="col">
                                    @if (in_array(auth()->user()->role, ['Super', 'Admin']))
                                        <a href="{{ route('atlet.fisik.create', ['atlet' => $atlet->id]) }}"
                                            class="btn btn-sm shadow-sm myBtn border rounded float-end"
                                            data-bs-toggle="tooltip" data-bs-placement="right" title="Tambah Fisik">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tinggi Badan</th>
                                            <th>Berat Badan</th>
                                            <th>Tahun Ambil</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($atlet->fisiks as $fisik)
                                            <tr>
                                                <td>{{ $fisik->tinggi }} cm</td>
                                                <td>{{ $fisik->berat }} kg</td>
                                                <td>{{ date('d M Y', strtotime($fisik->tahun_ambil_data)) }}</td>
                                                @if (in_array(auth()->user()->role, ['Super', 'Admin']))
                                                    <td>
                                                        <a class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0"
                                                            href="{{ route('atlet.fisik.edit', ['atlet' => $atlet->id, 'fisik' => $fisik->id]) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Ubah Fisik">
                                                            <svg width="25" xmlns="http://www.w3.org/2000/svg"
                                                                class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </a>
                                                        <form class="btn btn-sm p-0 m-0" method="POST"
                                                            id="delete-fisik-form-{{ $fisik->id }}"
                                                            action="{{ route('atlet.fisik.destroy', ['atlet' => $atlet->id, 'fisik' => $fisik->id]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0 delete"
                                                                id="{{ $fisik->id }}" model="fisik"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Hapus Fisik">
                                                                <svg width="25" xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </div>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    Tidak terdapat data fisik pada atlet ini
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 px-md-4">
                            <div class="row mb-2">
                                <div class="col">
                                    <h4>PPLP-D</h4>
                                </div>
                                <div class="col">
                                    @if (in_array(auth()->user()->role, ['Super', 'Admin']) && $atlet->pplps->count() < 1)
                                        <a href="{{ route('atlet.pplp.create', ['atlet' => $atlet->id]) }}"
                                            class="btn btn-sm shadow-sm myBtn border rounded float-end"
                                            data-bs-toggle="tooltip" data-bs-placement="right" title="Tambah PPLP">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Cabang Olahraga</th>
                                            <th>Tahun Masuk</th>
                                            <th>Tahun Selesai</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($atlet->pplps as $pplp)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('cabor.show', ['cabor' => $pplp->cabor->id]) }}">
                                                        {{ $pplp->cabor->nama }}
                                                    </a>
                                                </td>
                                                <td>{{ date('d M Y', strtotime($pplp->tahun_mulai)) }}</td>
                                                <td>{{ $pplp->tahun_selesai ?? 'Belum diisi' }}</td>
                                                <td>{{ $pplp->status() }}</td>
                                                @if (in_array(auth()->user()->role, ['Super', 'Admin']))
                                                    <td>
                                                        <a class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0"
                                                            href="{{ route('atlet.pplp.edit', ['atlet' => $atlet->id, 'pplp' => $pplp->id]) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Ubah pplp">
                                                            <svg width="25" xmlns="http://www.w3.org/2000/svg"
                                                                class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </a>
                                                        <form
                                                            action="{{ route('atlet.pplp.destroy', ['atlet' => $atlet->id, 'pplp' => $pplp->id]) }}"
                                                            method="POST" id="delete-pplp-form-{{ $pplp->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0 delete"
                                                                id="{{ $pplp->id }}" model="pplp"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Delete PPLP">
                                                                <svg width="25" xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </div>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    Tidak terdapat data fisik pada atlet ini
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 px-md-4">
                            <div class="row mb-2">
                                <div class="col">
                                    <h4>Sekolah</h4>
                                </div>
                                <div class="col">
                                    @if (in_array(auth()->user()->role, ['Super', 'Admin']))
                                        <a href="{{ route('atlet.sekolah.create', ['atlet' => $atlet->id]) }}"
                                            class="btn btn-sm shadow-sm myBtn border rounded float-end"
                                            data-bs-toggle="tooltip" data-bs-placement="right" title="Tambah Sekolah">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Sekolah</th>
                                            <th>Jenjang</th>
                                            <th>Tahun Masuk</th>
                                            <th>Tahun Selesai</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($atlet->sekolahs as $sekolah)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('sekolah.show', ['sekolah' => $sekolah->id]) }}">
                                                        {{ $sekolah->nama }}
                                                    </a>
                                                </td>
                                                <td>{{ $sekolah->jenjang }}</td>
                                                <td>{{ date('d M Y', strtotime($sekolah->pivot->tahun_mulai)) }}</td>
                                                <td>{{ !empty($sekolah->pivot->tahun_selesai) ? date('d M Y', strtotime($sekolah->pivot->tahun_selesai)) : 'Belum diisi' }}
                                                </td>
                                                <td>{{ $sekolah->status() }}</td>
                                                @if (in_array(auth()->user()->role, ['Super', 'Admin']))
                                                    <td>
                                                        {{-- <a class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0"
                                                            href="{{ route('atlet.sekolah.edit', ['atlet' => $atlet->id, 'sekolah' => $sekolah->id]) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Ubah sekolah">
                                                            <svg width="25" xmlns="http://www.w3.org/2000/svg"
                                                                class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        </a> --}}
                                                        <form
                                                            action="{{ route('atlet.sekolah.destroy', ['atlet' => $atlet->id, 'sekolah' => $sekolah->id]) }}"
                                                            method="POST" id="delete-sekolah-form-{{ $sekolah->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0 delete"
                                                                id="{{ $sekolah->id }}" model="sekolah"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Delete sekolah">
                                                                <svg width="25" xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </div>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">
                                                    Tidak terdapat data sekolah
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 px-md-4">
                            <div class="row mb-2">
                                <div class="col">
                                    <h4>Prestasi</h4>
                                </div>
                                {{-- <div class="col">
                                    @if (in_array(auth()->user()->role, ['Super', 'Admin']))
                                        <a href="{{ route('atlet.prestasi.create', ['atlet' => $atlet->id]) }}"
                                            class="btn btn-sm shadow-sm myBtn border rounded float-end"
                                            data-bs-toggle="tooltip" data-bs-placement="right" title="Tambah Prestasi">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    @endif
                                </div> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($atlet->prestasis as $prestasi)
                                            <tr>
                                                <td>{{ $prestasi->judul }}</td>
                                                <td>{{ $prestasi->keterangan }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('atlet.prestasi.destroy', ['atlet' => $atlet->id, 'prestasi' => $prestasi->id]) }}"
                                                        method="POST" id="delete-prestasi-form-{{ $prestasi->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0 delete"
                                                            id="{{ $prestasi->id }}" model="prestasi"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Delete prestasi">
                                                            <svg width="25" xmlns="http://www.w3.org/2000/svg"
                                                                class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">
                                                    Belum ada data prestasi
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 px-md-4">
                            <div class="row mb-2">
                                <div class="col">
                                    <h4>Kejuaraan</h4>
                                </div>
                                <div class="col">
                                    {{-- @if (in_array(auth()->user()->role, ['Super', 'Admin']))
                                        <a href="{{ route('atlet.prestasi.create', ['atlet' => $atlet->id]) }}"
                                            class="btn btn-sm shadow-sm myBtn border rounded float-end"
                                            data-bs-toggle="tooltip" data-bs-placement="right" title="Tambah Prestasi">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    @endif --}}
                                </div>
                            </div>
                            @forelse ($atlet->pplps as $pplp)
                                <h6>{{ $pplp->cabor->nama }}</h6>
                                <ul>
                                    @forelse ($pplp->cabor->pertandinganPada($pplp->tahun_mulai, $pplp->tahun_selesai) as $pertandingan)
                                        <li>
                                            <a href="{{route('pertandingan.show',['pertandingan'=>$pertandingan])}}">
                                                {{ $pertandingan->nama }}
                                            </a>
                                            ~ {{ $pertandingan->hasil }}
                                            ({{ date('d M Y', strtotime($pertandingan->tanggal_selesai)) }})
                                        </li>
                                    @empty
                                        <li>
                                            Belum ada kejuaraan yang diikuti
                                        </li>
                                    @endforelse
                                </ul>

                            @empty
                                <p class="">
                                    Belum ada data prestasi
                                </p>
                            @endforelse
                        </div>
                    </div>
                    {{-- <hr> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $('.delete').click(function() {
            var id = $(this).attr('id');
            var model = $(this).attr('model');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Apakah kamu yakin?',
                text: "Data akan dihapus! data tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel! ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    id = '#delete-' + model + '-form-' + id
                    $(id).submit();
                }
            })
        });

    </script>
@endsection
