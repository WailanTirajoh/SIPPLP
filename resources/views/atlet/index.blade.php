@extends('template.master')
@section('title', 'Atlet')
@section('head')
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <link href="{{ asset('package/select2/css/select2.css') }}" rel="stylesheet" />
    <script src="{{ asset('package/select2/js/select2.js') }}"></script>
@endsection
@section('content')
    <style>
        .select2-container .select2-selection--single {
            height: 34px !important;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ccc !important;
            border-radius: 0px !important;
        }

    </style>
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-1 mb-1">
                <div class="d-grid gap-2 d-md-block">
                    <a href="{{ route('atlet.create') }}" class="btn btn-sm shadow-sm myBtn border rounded"
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Tambah atlet">
                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-sm-11">
                <form method="GET" action="{{ route('atlet.index') }}">
                    <div class="row">
                        <div class="col-sm-2 mb-1">
                            <select id="cabor" name="cabor"
                                class="form-select select2 @error('password') is-invalid @enderror">
                                <option value="" @if (request()->input('cabor') == '') selected @endif>Semua Cabor</option>
                                @forelse ($cabors as $cabor)
                                    <option value="{{ $cabor->nama }}" @if (request()->input('cabor') == $cabor->nama) selected @endif>
                                        {{ $cabor->nama }}</option>
                                @empty
                                    <option disabled>Tidak ada cabor</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-sm-3 col-6  mb-1">
                            {{-- <label for="dari" class="form-label">Dari</label> --}}
                            <input type="date" class="form-control @error('dari') is-invalid @enderror" id="dari"
                                name="dari" value="{{ request()->input('dari') }}">
                            @error('dari')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-3 col-6 mb-1">
                            {{-- <label for="sampai" class="form-label">Sampai</label> --}}
                            <input type="date" class="form-control @error('sampai') is-invalid @enderror" id="sampai"
                                name="sampai" value="{{ request()->input('sampai') }}">
                            @error('sampai')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-4 d-flex mb-1">
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-sm border">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" style="white-space: nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th></th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Sekolah</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Cabang Olahraga</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($atlets as $atlet)
                                                <tr>

                                                    <td scope="row">
                                                        {{ ($atlets->currentpage() - 1) * $atlets->perpage() + $loop->index + 1 }}
                                                    </td>
                                                    <td>
                                                        {{-- <img src="{{ $atlet->user->getAvatar() }}" alt="" width="50px"
                                                            class="me-2 rounded"> --}}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('atlet.show', compact('atlet')) }}">
                                                            {{ $atlet->user->name }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @forelse ($atlet->filterSekolah(request()->input('dari'),request()->input('sampai')) as $sekolah)
                                                            <a
                                                                href="{{ route('sekolah.show', ['sekolah' => $sekolah->id, 'dari' => request()->input('dari'), 'sampai' => request()->input('sampai')]) }}">
                                                                {{ $sekolah->nama }} <br>
                                                            </a>
                                                        @empty
                                                            Tidak ada data
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        @forelse ($atlet->filterSekolah(request()->input('dari'),request()->input('sampai')) as $sekolah)
                                                            {{ $sekolah->kelas(request()->input('dari'), request()->input('sampai')) }}
                                                            <br>
                                                        @empty
                                                            Tidak ada data
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        @forelse ($atlet->pplps as $pplp)
                                                            <a
                                                                href="{{ route('cabor.show', ['cabor' => $pplp->cabor, 'dari' => request()->input('dari'), 'sampai' => request()->input('sampai')]) }}">
                                                                {{ $pplp->cabor->nama }}
                                                            </a>
                                                        @empty
                                                            Tidak ada data
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        @forelse ($atlet->pplps as $pplp)
                                                            {{ $pplp->status(request()->input('sampai')) }}
                                                        @empty
                                                            Tidak ada data
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        <form class="btn btn-sm p-0 m-0" method="POST"
                                                            id="delete-post-form-{{ $atlet->id }}"
                                                            action="{{ route('atlet.destroy', ['atlet' => $atlet->id]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0 delete"
                                                                atlet-id="{{ $atlet->id }}"
                                                                atlet-name="{{ $atlet->name }}" data-bs-toggle="tooltip"
                                                                atlet-role="Admin" data-bs-placement="top"
                                                                title="Hapus atlet">
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
                                                    <td colspan="10" class="text-center">
                                                        Tidak ada data
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="card-footer">
                                <h4>
                                    Atlet  ~ {{ $atlets->count() }} orang
                                    @if (!empty(request()->input('dari')))
                                        ({{ date('d M Y', strtotime(request()->input('dari'))) }} -
                                        {{ date('d M Y', strtotime(request()->input('sampai'))) }})
                                    @endif
                                </h4>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="row justify-content-md-center mt-3">
                    <div class="col-sm-10 d-flex mx-auto justify-content-md-center">
                        <div class="pagination-block">
                            {{ $atlets->onEachSide(1)->appends(['qc' => request()->input('qc')])->links('template.paginationlinks') }}
                        </div>
                    </div>
                </div>
            </div>
            {{-- @if (empty(request()->input('dari')))
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow-sm border">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" style="white-space: nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th></th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Sekolah</th>
                                                    <th scope="col">Status Sekolah</th>
                                                    <th scope="col">PPLP</th>
                                                    <th scope="col">Status PPLP</th>
                                                    <th scope="col">Masuk PPLP</th>
                                                    <th scope="col">Selesai PPLP</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($unAcitveAtlets as $atlet)
                                                    <tr>

                                                        <td scope="row">
                                                            {{ ($atlets->currentpage() - 1) * $atlets->perpage() + $loop->index + 1 }}
                                                        </td>
                                                        <td>
                                                            <img src="{{ $atlet->user->getAvatar() }}" alt=""
                                                                width="50px" class="me-2 rounded">
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('atlet.show', compact('atlet')) }}">
                                                                {{ $atlet->user->name }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @forelse ($atlet->filterSekolah(request()->input('dari'),request()->input('sampai')) as $sekolah)
                                                                <a
                                                                    href="{{ route('sekolah.show', ['sekolah' => $sekolah->id]) }}">
                                                                    {{ $sekolah->nama }} <br>
                                                                </a>
                                                            @empty
                                                                Tidak ada data
                                                            @endforelse
                                                        </td>
                                                        <td>
                                                            @forelse ($atlet->filterSekolah(request()->input('dari'),request()->input('sampai')) as $sekolah)
                                                                {{ $sekolah->kelas(request()->input('dari'), request()->input('sampai')) }}
                                                                <br>
                                                            @empty
                                                                Tidak ada data
                                                            @endforelse
                                                        </td>
                                                        <td>
                                                            @forelse ($atlet->pplps as $pplp)
                                                                <a
                                                                    href="{{ route('cabor.show', ['cabor' => $pplp->cabor]) }}">
                                                                    {{ $pplp->cabor->nama }}
                                                                </a>
                                                            @empty
                                                                Tidak ada data
                                                            @endforelse
                                                        </td>
                                                        <td>
                                                            @forelse ($atlet->pplps as $pplp)
                                                                {{ $pplp->status() }}
                                                            @empty
                                                                Tidak ada data
                                                            @endforelse
                                                        </td>
                                                        <td>
                                                            @forelse ($atlet->pplps as $pplp)
                                                                {{ $pplp->tahun_mulai }}

                                                            @empty

                                                            @endforelse
                                                        </td>
                                                        <td>
                                                            @forelse ($atlet->pplps as $pplp)
                                                            {{ $pplp->tahun_selesai ?? 'Belum Diisi' }}
                                                            @empty
                                                            @endforelse
                                                        </td>
                                                        <td>
                                                            <form class="btn btn-sm p-0 m-0" method="POST"
                                                                id="delete-post-form-{{ $atlet->id }}"
                                                                action="{{ route('atlet.destroy', ['atlet' => $atlet->id]) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0 delete"
                                                                    atlet-id="{{ $atlet->id }}"
                                                                    atlet-name="{{ $atlet->name }}"
                                                                    data-bs-toggle="tooltip" atlet-role="Admin"
                                                                    data-bs-placement="top" title="Hapus atlet">
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
                                                        <td colspan="10" class="text-center">
                                                            Tidak ada data
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <h4>Alumni ~ {{ $unAcitveAtlets->count() }} orang</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-md-center mt-3">
                        <div class="col-sm-10 d-flex mx-auto justify-content-md-center">
                            <div class="pagination-block">
                                {{ $atlets->onEachSide(1)->appends(['qc' => request()->input('qc')])->links('template.paginationlinks') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif --}}
        </div>
    </div>
    <script>
        $('.select2').select2();

    </script>
@endsection

@section('footer')
    <script>
        $('.delete').click(function() {
            var atlet_id = $(this).attr('atlet-id');
            var atlet_name = $(this).attr('atlet-name');
            var atlet_role = $(this).attr('atlet-role');
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
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel! ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    if (atlet_role == "Customer") {
                        id = '#delete-post-form-customer-' + atlet_id
                        $(id).submit();
                    } else {
                        id = '#delete-post-form-' + atlet_id
                        $(id).submit();
                    }
                }
            })
        });

    </script>
@endsection
