@extends('template.master')
@section('title', 'Edit Sekolah')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Tambah sekolah Atlet (Belum)
                        </h4>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST"
                            action="{{ route('atlet.sekolah.store', ['atlet' => $atlet->id]) }}">
                            @csrf
                            <div class=" col-md-12">
                                <label for="sekolah_id" class="form-label">Sekolah *</label>
                                <select id="sekolah_id" name="sekolah_id"
                                    class="form-select select2 @error('password') is-invalid @enderror">
                                    <option selected disabled hidden>Choose...</option>
                                    @forelse ($sekolahs as $sklh)
                                        <option value="{{ $sklh->id }}" @if ($sekolah->id == $sklh->id) selected @endif>{{ $sklh->nama }}</option>
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
                                    id="tanggal_mulai_sekolah" name="tanggal_mulai_sekolah"
                                    value="{{ $atlet->sekolahs[0]->pivot->tahun_mulai }}">
                                @error('tanggal_mulai_sekolah')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_selesai_sekolah" class="form-label">Tanggal Selesai (Kosongkan jika
                                    masih menempuh)</label>
                                <input type="date"
                                    class="form-control @error('tanggal_selesai_sekolah') is-invalid @enderror"
                                    id="tanggal_selesai_sekolah" name="tanggal_selesai_sekolah"
                                    value="{{ $atlet->sekolahs[0]->pivot->tahun_selesai }}">
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
                                    <option value="1" @if ($atlet->sekolahs[0]->pivot->masuk_kelas == '1') selected @endif>1</option>
                                    <option value="2" @if ($atlet->sekolahs[0]->pivot->masuk_kelas == '2') selected @endif>2</option>
                                    <option value="3" @if ($atlet->sekolahs[0]->pivot->masuk_kelas == '3') selected @endif>3</option>
                                </select>
                                @error('masuk_kelas')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-light shadow-sm border float-end">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
