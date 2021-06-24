@extends('template.master')
@section('title', 'Pelatih')
@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-lg-1">
                <div class="d-grid gap-2 d-md-block">
                    <a href="{{ route('pelatih.create') }}" class="btn btn-sm shadow-sm myBtn border rounded"
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Add pelatih">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-11">
                <form method="GET" action="{{ route('pelatih.index') }}">
                    <div class="row">
                        <div class="col-lg-7">

                        </div>
                        <div class="col-lg-5 d-flex">
                            <input class="form-control me-2" type="search" placeholder="Ketikkan sesuatu"
                                aria-label="Search" id="search-atlet" name="search"
                                value="{{ request()->input('search') }}">
                            <button class="btn btn-sm shadow-sm myBtn border rounded w-25" type="submit">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" style="white-space: nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Cabang Olahraga</th>
                                        <th scope="col">Masa Latih</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pelatihs as $pelatih)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('pelatih.show', ['pelatih' => $pelatih->id]) }}">
                                                    {{ $pelatih->user->name }}
                                                </a>
                                            </td>
                                            <td>
                                                @forelse ($pelatih->tahuns as $tahun)
                                                    <a href="{{ route('cabor.show', ['cabor' => $tahun->cabor]) }}">
                                                        {{ $tahun->cabor->nama }}
                                                    </a>
                                                    <br>
                                                @empty
                                                    Tidak ada data
                                                @endforelse
                                            </td>
                                            <td>
                                                @forelse ($pelatih->tahuns as $tahun)
                                                    {{ $tahun->tahun_mulai }} ~
                                                    {{ $tahun->tahun_selesai ?? 'Belum diisi' }} <br>
                                                @empty
                                                    Tidak ada data
                                                @endforelse
                                            </td>
                                            <td>
                                                <form class="btn btn-sm p-0 m-0" method="POST"
                                                    id="delete-post-form-{{ $pelatih->id }}"
                                                    action="{{ route('pelatih.destroy', ['pelatih' => $pelatih->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0 delete"
                                                        pelatih-id="{{ $pelatih->id }}"
                                                        pelatih-name="{{ $pelatih->name }}" data-bs-toggle="tooltip"
                                                        pelatih-role="Admin" data-bs-placement="top" title="Hapus pelatih">
                                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                            <td colspan="5" class="text-center">
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="card-footer">
                        <h3>Pelatih</h3>
                    </div> --}}
                </div>
                <div class="row justify-content-md-center mt-3">
                    <div class="col-sm-10 d-flex mx-auto justify-content-md-center">
                        <div class="pagination-block">
                            {{ $pelatihs->onEachSide(1)->appends(['qc' => request()->input('qc')])->links('template.paginationlinks') }}
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
            var pelatih_id = $(this).attr('pelatih-id');
            var pelatih_name = $(this).attr('pelatih-name');
            var pelatih_role = $(this).attr('pelatih-role');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Apakah kamu yakin?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak, batal! ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    id = '#delete-post-form-' + pelatih_id
                    $(id).submit();
                }
            })
        });

    </script>
@endsection
