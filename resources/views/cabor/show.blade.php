@extends('template.master')
@section('title', 'Data cabor')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Cabang Olahraga - {{ $cabor->nama }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-7">
                                <form action="{{ route('cabor.show', ['cabor' => $cabor->id]) }}" method="GET">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                {{-- <div class="col-sm-1">
                                                    <h5 class="float-end">Filter: </h5>
                                                </div> --}}
                                                <div class="col-sm-5">
                                                    {{-- <label for="dari" class="form-label">Dari</label> --}}
                                                    <input type="date"
                                                        class="form-control @error('dari') is-invalid @enderror" id="dari"
                                                        name="dari" value="{{ request()->input('dari') }}">
                                                    @error('dari')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-5">
                                                    {{-- <label for="sampai" class="form-label">Sampai</label> --}}
                                                    <input type="date"
                                                        class="form-control @error('sampai') is-invalid @enderror"
                                                        id="sampai" name="sampai"
                                                        value="{{ request()->input('sampai') }}">
                                                    @error('sampai')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit"
                                                        class="btn btn-light shadow-sm border w-100">Cari</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-7">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h5 class="text-center">Atlet
                                                    @if (!empty(request()->input('sampai')))
                                                        ({{ request()->input('dari') }} ~
                                                        {{ request()->input('sampai') }})
                                                    @else
                                                        (Seluruh waktu)
                                                    @endif
                                                </h5>
                                                <hr>
                                                <div class="row">
                                                    @forelse ($pplps as $pplp)
                                                        <div class="col-lg-4 col-md-4 col-sm-6 my-1">

                                                            <div class="card shadow-sm justify-content-start"
                                                                style="min-height:150px; ">
                                                                <img src="{{ $pplp->atlet->user->getAvatar() }}"
                                                                    style="object-fit: cover; height:150px; border-top-right-radius: 0.5rem; border-top-left-radius: 0.5rem;">
                                                                <div class="card-body p-1">
                                                                    <div class="card-text">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="table-responsive">
                                                                                    <table style="white-space:nowrap"
                                                                                        class="overflow-hidden">
                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                                <a
                                                                                                    href="{{ route('atlet.show', ['atlet' => $pplp->atlet->id]) }}">
                                                                                                    <h5>
                                                                                                        {{ $pplp->atlet->user->name }}
                                                                                                    </h5>
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    @forelse ($pplp->atlet->filterSekolah(request()->input('dari'),request()->input('sampai')) as $sekolah)
                                                                        {{ $sekolah->kelas(request()->input('dari'), request()->input('sampai')) }}
                                                                    @empty

                                                                    @endforelse
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @empty
                                                        <p class="text-center">-</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h5 class="text-center">Pelatih
                                                            @if (!empty(request()->input('sampai')))
                                                                ({{ request()->input('dari') }} ~
                                                                {{ request()->input('sampai') }})
                                                            @else
                                                                (Seluruh waktu)
                                                            @endif
                                                        </h5>
                                                        <hr>
                                                        <div class="row">
                                                            @forelse ($tahuns as $tahun)
                                                                <div class="col-lg-6 col-md-6 col-sm-6 my-1">
                                                                    <a
                                                                        href="{{ route('pelatih.show', ['pelatih' => $tahun->pelatih->id]) }}">
                                                                        <div class="card shadow-sm justify-content-start"
                                                                            style="min-height:150px; ">
                                                                            <img src="{{ $tahun->pelatih->user->getAvatar() }}"
                                                                                style="object-fit: cover; height:150px; border-top-right-radius: 0.5rem; border-top-left-radius: 0.5rem;">
                                                                            <div class="card-body">
                                                                                <div class="card-text">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <div class="table-responsive">
                                                                                                <table
                                                                                                    style="white-space:nowrap"
                                                                                                    class="overflow-hidden">
                                                                                                    <tr>
                                                                                                        <td colspan="2">
                                                                                                            <h5>
                                                                                                                {{ $tahun->pelatih->user->name }}
                                                                                                            </h5>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            @empty
                                                                <p class="text-center">-</p>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h5>Kejuaraan</h5>
                                                    </div>
                                                    <div class="col-sm-6 mb-2">
                                                        <div class="d-grid gap-2 d-md-block">
                                                            <a href="{{ route('cabor.pertandingan.create', ['cabor' => $cabor->id]) }}"
                                                                class="btn btn-sm shadow-sm myBtn border rounded float-end"
                                                                data-bs-toggle="tooltip" data-bs-placement="right"
                                                                title="Add Pertandingan">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>Tanggal Pertandingan</td>
                                                                    <td>Hasil</td>
                                                                    <td>Aksi</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($pertandingans as $pertandingan)
                                                                    <tr>
                                                                        <td>
                                                                            <a
                                                                                href="{{ route('pertandingan.show', ['pertandingan' => $pertandingan->id]) }}">
                                                                                {{ $pertandingan->nama }}
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            {{ date('d M Y', strtotime($pertandingan->tanggal_mulai)) }}
                                                                            <br>
                                                                            ~
                                                                            <br>
                                                                            {{ date('d M Y', strtotime($pertandingan->tanggal_selesai)) }}
                                                                        </td>
                                                                        <td>{{ $pertandingan->hasil }}</td>
                                                                        <td>
                                                                            <form
                                                                                action="{{ route('pertandingan.destroy', ['pertandingan' => $pertandingan]) }}"
                                                                                method="post"
                                                                                id="delete-post-form-{{ $pertandingan->id }}">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <div class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0 delete"
                                                                                    pertandingan-id="{{ $pertandingan->id }}"
                                                                                    pertandingan-name="{{ $pertandingan->nama }}"
                                                                                    data-bs-toggle="tooltip"
                                                                                    pertandingan-role="Admin"
                                                                                    data-bs-placement="top"
                                                                                    title="Delete pertandingan">
                                                                                    <svg width="25"
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        class="h-6 w-6" fill="none"
                                                                                        viewBox="0 0 24 24"
                                                                                        stroke="currentColor">
                                                                                        <path stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            stroke-width="2"
                                                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                                    </svg>
                                                                                </div>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td colspan="4" class="text-center">
                                                                            -
                                                                        </td>
                                                                    </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('footer')
    <script>
        $('.delete').click(function() {
            var pertandingan_id = $(this).attr('pertandingan-id');
            var pertandingan_name = $(this).attr('pertandingan-name');
            var pertandingan_role = $(this).attr('pertandingan-role');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Apakah kamu yakin?',
                text: pertandingan_name + " akan dihapus, data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!!',
                cancelButtonText: 'Tidak, Batal! ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    id = '#delete-post-form-' + pertandingan_id
                    $(id).submit();
                }
            })
        });

    </script>
@endsection
