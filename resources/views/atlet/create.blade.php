@extends('template.master')
@section('title', 'Add atlet')
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
        <div class="row">
            <div class="col-lg-12">
                <form class="row g-3" method="POST" action="{{ route('atlet.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Data Diri Atlet
                            </div>
                            <div class="card-body">
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
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" " id="
                                            email" name="email" value="{{ old('email') }}">
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
                                        <select id="agama" name="agama"
                                            class="form-select @error('password') is-invalid @enderror">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                PPLP - D
                            </div>
                            <div class="card-body">
                                <div class="row">
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
                                        <label for="tanggal_mulai_pplp" class="form-label">Tanggal Masuk *</label>
                                        <input type="date" class="form-control @error('tanggal_mulai_pplp') is-invalid @enderror"
                                            id="tanggal_mulai_pplp" name="tanggal_mulai_pplp" value="{{ old('tanggal_mulai_pplp') }}">
                                        @error('tanggal_mulai_pplp')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_selesai_pplp" class="form-label">Tanggal Selesai (Kosongkan jika masih menempuh)</label>
                                        <input type="date" class="form-control @error('tanggal_selesai_pplp') is-invalid @enderror"
                                            id="tanggal_selesai_pplp" name="tanggal_selesai_pplp" value="{{ old('tanggal_selesai_pplp') }}">
                                        @error('tanggal_selesai_pplp')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Sekolah
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class=" col-md-12">
                                        <label for="sekolah_id" class="form-label">Sekolah *</label>
                                        <select id="sekolah_id" name="sekolah_id"
                                            class="form-select select2 @error('password') is-invalid @enderror">
                                            <option selected disabled hidden>Choose...</option>
                                            @forelse ($sekolahs as $sekolah)
                                                <option value="{{ $sekolah->id }}" @if (old('sekolah_id') ==  $sekolah->id ) selected @endif>{{ $sekolah->nama }}</option>
                                            @empty
                                                <option disabled>Tidak ada sekolah</option>
                                            @endforelse
                                        </select>
                                        @error('sekolah_id')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_mulai_sekolah" class="form-label">Tanggal Masuk *</label>
                                        <input type="date" class="form-control @error('tanggal_mulai_sekolah') is-invalid @enderror"
                                            id="tanggal_mulai_sekolah" name="tanggal_mulai_sekolah" value="{{ old('tanggal_mulai_sekolah') }}">
                                        @error('tanggal_mulai_sekolah')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_selesai_sekolah" class="form-label">Tanggal Selesai (Kosongkan jika masih menempuh)</label>
                                        <input type="date" class="form-control @error('tanggal_selesai_sekolah') is-invalid @enderror"
                                            id="tanggal_selesai_sekolah" name="tanggal_selesai_sekolah" value="{{ old('tanggal_selesai_sekolah') }}">
                                        @error('tanggal_selesai_sekolah')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class=" col-md-12">
                                        <label for="masuk_kelas" class="form-label">Masuk Kelas? *</label>
                                        <select id="masuk_kelas" name="masuk_kelas"
                                            class="form-select @error('password') is-invalid @enderror">
                                            <option selected disabled hidden>Choose...</option>
                                            <option value="1" @if (old('masuk_kelas') == '1') selected @endif>1</option>
                                            <option value="2" @if (old('masuk_kelas') == '2') selected @endif>2</option>
                                            <option value="3" @if (old('masuk_kelas') == '3') selected @endif>3</option>
                                        </select>
                                        @error('masuk_kelas')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Data Fisik
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="tinggi" class="form-label">Tinggi Badan (CM) *</label>
                                        <input type="text" class="form-control @error('tinggi') is-invalid @enderror"
                                            id="tinggi" name="tinggi" value="{{ old('tinggi') }}">
                                        @error('tinggi')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="berat" class="form-label">Berat Badan (KG) *</label>
                                        <input type="text" class="form-control @error('berat') is-invalid @enderror" id="berat"
                                            name="berat" value="{{ old('berat') }}">
                                        @error('berat')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="tahun_ambil_data" class="form-label">Tahun Pengambilan Data *</label>
                                        <input type="date" class="form-control @error('tahun_ambil_data') is-invalid @enderror" id="tahun_ambil_data"
                                            name="tahun_ambil_data" value="{{ old('tahun_ambil_data') }}">
                                        @error('tahun_ambil_data')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Alamat (KTP)
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="alamat" class="form-label">Alamat *</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            id="alamat" name="alamat" value="{{ old('alamat') }}">
                                        @error('alamat')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rt_rw" class="form-label">RT/RW *</label>
                                        <input type="text" class="form-control @error('rt_rw') is-invalid @enderror" id="rt_rw"
                                            name="rt_rw" value="{{ old('rt_rw') }}">
                                        @error('rt_rw')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kel_desa" class="form-label">Kel/Desa *</label>
                                        <input type="text" class="form-control @error('kel_desa') is-invalid @enderror"
                                            id="kel_desa" name="kel_desa" value="{{ old('kel_desa') }}">
                                        @error('kel_desa')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="kecamatan" class="form-label">Kecamatan *</label>
                                        <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                            id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}">
                                        @error('kecamatan')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn myBtn border rounded shadow-sm float-end"
                            style="width:100%">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('.select2').select2();

    </script>
@endsection
