@extends('template.master')
@section('title', 'Tambah pelatih')
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
        <div class="card shadow-sm border">
            <div class="card-header">
                <h2>Tambah Pelatih</h2>
            </div>
            <div class="card-body p-3">
                <form class="row g-3" method="POST" action="{{ route('pelatih.store') }}">
                    @csrf
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" " id=" email"
                                    name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class=" col-md-12">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="form-select @error('password') is-invalid @enderror">
                                    <option selected disabled hidden>Choose...</option>
                                    <option value="Laki-laki" @if (old('jenis_kelamin') == 'Laki-laki') selected @endif>Laki-laki</option>
                                    <option value="Perempuan" @if (old('jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class=" col-md-12">
                                <label for="agama" class="form-label">Agama *</label>
                                <select id="agama" name="agama" class="form-select @error('password') is-invalid @enderror">
                                    <option selected disabled hidden>Choose...</option>
                                    <option value="Kristen" @if (old('agama') == 'Kristen') selected @endif>Kristen</option>
                                    <option value="Katholik" @if (old('agama') == 'Katholik') selected @endif>Katholik</option>
                                    <option value="Islam" @if (old('agama') == 'Islam') selected @endif>Islam</option>
                                    <option value="Konghucu" @if (old('agama') == 'Konghucu') selected @endif>Konghucu</option>
                                    <option value="Budha" @if (old('agama') == 'Budha') selected @endif>Budha</option>
                                </select>
                                @error('agama')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir *</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir *</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar"
                                    name="avatar" value="{{ old('avatar') }}">
                                @error('avatar')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <hr class="my-4">
                            <div class=" col-md-12">
                                <label for="cabor_id" class="form-label">Cabang Olahraga *</label>
                                <select id="cabor_id" name="cabor_id"
                                    class="form-select select2 @error('password') is-invalid @enderror">
                                    <option selected disabled hidden>Choose...</option>
                                    @forelse ($cabors as $cabor)
                                        <option value="{{ $cabor->id }}" @if (old('cabor_id') == $cabor->id) selected @endif>{{ $cabor->nama }}</option>
                                    @empty
                                        <option disabled>Tidak ada cabor</option>
                                    @endforelse
                                </select>
                                @error('cabor_id')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai *</label>
                                <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                    id="tanggal_mulai" name="tanggal_mulai"
                                    value="{{ old('tanggal_mulai') }}">
                                @error('tanggal_mulai')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai (Kosongkan jika
                                    masih menempuh)</label>
                                <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                    id="tanggal_selesai" name="tanggal_selesai"
                                    value="{{ old('tanggal_selesai') }}">
                                @error('tanggal_selesai')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn myBtn shadow-sm border float-end w-100">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
    <script>
        $('.select2').select2();
    </script>
@endsection
