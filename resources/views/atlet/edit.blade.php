@extends('template.master')
@section('title', 'Edit atlet')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border">
                    <div class="card-header">
                        <h2>Edit atlet</h2>
                    </div>
                    <div class="card-body p-3">
                        <form class="row g-3" method="POST" action="{{ route('atlet.update', ['atlet' => $atlet->id]) }}" enctype="multipart/form-data">
                            @method('PUT')
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
                                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                    id="name" name="name" value="{{ $atlet->user->name }}">
                                                @error('name')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email *</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" id=" email"
                                                    name="email" value="{{ $atlet->user->email }}" @if(auth()->user()->role != 'Super') disabled @endif>
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
                                                    <option value="Laki-laki" @if ($atlet->jenis_kelamin == 'Laki-laki') selected @endif>Laki-laki</option>
                                                    <option value="Perempuan" @if ($atlet->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
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
                                                    <option value="Kristen" @if ($atlet->agama == 'Kristen') selected @endif>Kristen</option>
                                                    <option value="Katholik" @if ($atlet->agama == 'Katholik') selected @endif>Katholik</option>
                                                    <option value="Islam" @if ($atlet->agama == 'Islam') selected @endif>Islam</option>
                                                    <option value="Konghucu" @if ($atlet->agama == 'Konghucu') selected @endif>Konghucu</option>
                                                    <option value="Budha" @if ($atlet->agama == 'Budha') selected @endif>Budha</option>
                                                </select>
                                                @error('agama')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="tempat_lahir" class="form-label">Tempat Lahir *</label>
                                                <input type="text"
                                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                    id="tempat_lahir" name="tempat_lahir" value="{{ $atlet->tempat_lahir }}">
                                                @error('tempat_lahir')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir *</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                    id="tanggal_lahir" name="tanggal_lahir"
                                                    value="{{ $atlet->tanggal_lahir }}">
                                                @error('tanggal_lahir')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label for="avatar" class="form-label">Avatar</label>
                                                <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                                    id="avatar" name="avatar" value="{{ $atlet->avatar }}">
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
                                        Alamat (KTP)
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="alamat" class="form-label">Alamat *</label>
                                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                    id="alamat" name="alamat" value="{{ $atlet->alamat->alamat }}">
                                                @error('alamat')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="rt_rw" class="form-label">RT/RW *</label>
                                                <input type="text" class="form-control @error('rt_rw') is-invalid @enderror"
                                                    id="rt_rw" name="rt_rw" value="{{ $atlet->alamat->rt_rw }}">
                                                @error('rt_rw')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="kel_desa" class="form-label">Kel/Desa *</label>
                                                <input type="text" class="form-control @error('kel_desa') is-invalid @enderror"
                                                    id="kel_desa" name="kel_desa" value="{{ $atlet->alamat->kel_desa }}">
                                                @error('kel_desa')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label for="kecamatan" class="form-label">Kecamatan *</label>
                                                <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                                    id="kecamatan" name="kecamatan" value="{{ $atlet->alamat->kecamatan }}">
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
                                <button type="submit" class="btn btn-sm shadow-sm myBtn border rounded w-100">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
