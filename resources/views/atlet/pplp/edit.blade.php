@extends('template.master')
@section('title', 'Ubah PPLP Atlet')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Ubah PPLP Atlet
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{route('atlet.pplp.update',['atlet'=>$atlet->id, 'pplp' => $pplp->id])}}">
                            @csrf
                            <div class=" col-md-12">
                                <label for="cabor_id" class="form-label">Cabang Olahraga</label>
                                <select id="cabor_id" name="cabor_id"
                                    class="form-select select2 @error('password') is-invalid @enderror">
                                    <option selected disabled hidden>Choose...</option>
                                    @forelse ($cabors as $cabor)
                                        <option value="{{ $cabor->id }}" @if ($pplp->cabor_id == $cabor->id) selected @endif>{{ $cabor->nama }}</option>
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
                                <label for="tanggal_mulai_pplp" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control @error('tanggal_mulai_pplp') is-invalid @enderror"
                                    id="tanggal_mulai_pplp" name="tanggal_mulai_pplp" value="{{ $pplp->tahun_mulai }}">
                                @error('tanggal_mulai_pplp')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_selesai_pplp" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control @error('tanggal_selesai_pplp') is-invalid @enderror"
                                    id="tanggal_selesai_pplp" name="tanggal_selesai_pplp" value="{{ $pplp->tahun_selesai }}">
                                @error('tanggal_selesai_pplp')
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
