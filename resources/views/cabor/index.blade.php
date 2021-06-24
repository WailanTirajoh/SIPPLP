@extends('template.master')
@section('title', 'Cabor')
@section('content')
<div class="container">
            <div class="row mb-2">
                <div class="col-lg-1">
                    <div class="d-grid gap-2 d-md-block">
                        <a href="{{ route('cabor.create') }}" class="btn btn-sm shadow-sm myBtn border rounded"
                            data-bs-toggle="tooltip" data-bs-placement="right" title="Add cabor">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-11">
                    <form class="" method="GET" action="{{ route('cabor.index') }}">
                        <div class="row">
                            <div class="col-lg-7">

                            </div>
                            <div class="col-lg-5 d-flex">
                                <input class="form-control me-2" type="search" placeholder="Ketikkan sesuatu" aria-label="Search"
                                    id="search-atlet" name="search" value="{{ request()->input('search') }}">
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
                                            <th scope="col" class="text-center">Jumlah Atlet</th>
                                            <th scope="col" class="text-center">Jumlah Pelatih</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cabors as $cabor)
                                            <tr>
                                                <td scope="row">
                                                    {{ ($cabors->currentpage() - 1) * $cabors->perpage() + $loop->index + 1 }}
                                                </td>
                                                <td>
                                                    <a href="{{route('cabor.show', compact('cabor'))}}">
                                                        {{ $cabor->nama }}
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    {{$cabor->pplps->count()}}
                                                </td>
                                                <td class="text-center">
                                                    {{$cabor->tahuns->count()}}
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0"
                                                        href="{{ route('cabor.edit', ['cabor' => $cabor->id]) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit cabor">
                                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    <form class="btn btn-sm p-0 m-0" method="POST"
                                                        id="delete-post-form-{{ $cabor->id }}"
                                                        action="{{ route('cabor.destroy', ['cabor' => $cabor->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="btn btn-light btn-sm rounded shadow-sm border p-0 m-0 delete"
                                                            cabor-id="{{ $cabor->id }}" cabor-name="{{ $cabor->name }}"
                                                            data-bs-toggle="tooltip" cabor-role="Admin" data-bs-placement="top"
                                                            title="Delete cabor">
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
                                                <td colspan="10" class="text-center">
                                                    There's no data in this table
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h3>Cabor</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center mt-3">
                <div class="col-sm-10 d-flex mx-auto justify-content-md-center">
                    <div class="pagination-block">
                        {{ $cabors->onEachSide(1)->appends(['qc' => request()->input('qc')])->links('template.paginationlinks') }}
                    </div>
                </div>
            </div>
</div>

@endsection

@section('footer')
    <script>
        $('.delete').click(function() {
            var cabor_id = $(this).attr('cabor-id');
            var cabor_name = $(this).attr('cabor-name');
            var cabor_role = $(this).attr('cabor-role');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: cabor_name + " will be deleted, You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel! ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    if (cabor_role == "Customer") {
                        id = '#delete-post-form-customer-' + cabor_id
                        $(id).submit();
                    } else {
                        id = '#delete-post-form-' + cabor_id
                        $(id).submit();
                    }
                }
            })
        });

    </script>
@endsection
