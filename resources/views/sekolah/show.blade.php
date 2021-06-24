@extends('template.master')
@section('title', 'Data sekolah')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>{{ $sekolah->nama }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <form action="">
                                                <div class="col-sm-12 col-6  mb-1">
                                                    {{-- <label for="dari" class="form-label">Dari</label> --}}
                                                    <input type="date" class="form-control @error('dari') is-invalid @enderror" id="dari"
                                                        name="dari" value="{{ request()->input('dari') }}">
                                                    @error('dari')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12 col-6 mb-1">
                                                    {{-- <label for="sampai" class="form-label">Sampai</label> --}}
                                                    <input type="date" class="form-control @error('sampai') is-invalid @enderror" id="sampai"
                                                        name="sampai" value="{{ request()->input('sampai') }}">
                                                    @error('sampai')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-12">
                                                    <button class="btn btn-sm shadow-sm myBtn border rounded w-100" type="submit">Cari</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>Keterangan</h6>
                                        <p>Total Seluruh Atlet: {{ $atlets->count() }}</p>
                                        <table>
                                            @forelse ($cabors as $cabor)
                                                <tr>
                                                    <td>{{ $cabor->nama }}</td>
                                                    <td>: {{ $cabor->atletPadaSekolah($sekolah, request()->input('dari'), request()->input('sampai'))->count() }} Orang</td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @forelse ($atlets as $atlet)
                                        <div class="col-lg-4 col-md-4 col-sm-6 my-1">
                                            <div class="card shadow-sm justify-content-start" style="min-height:350px; ">
                                                <img src="{{ $atlet->user->getAvatar() }}"
                                                    style="object-fit: cover; height:200px; border-top-right-radius: 0.5rem; border-top-left-radius: 0.5rem;">
                                                <div class="card-body">
                                                    <div class="card-text">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="table-responsive">
                                                                            <table style="white-space:nowrap"
                                                                                class="overflow-hidden">
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <h5>
                                                                                            <a
                                                                                                href="{{ route('atlet.show', ['atlet' => $atlet->id]) }}">
                                                                                                {{ $atlet->user->name }}
                                                                                            </a>
                                                                                        </h5>

                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        @forelse ($atlet->pplps as $pplp)
                                                                                            <h6>
                                                                                                <a
                                                                                                    href="{{ route('cabor.show', ['cabor' => $pplp->cabor->id]) }}">
                                                                                                    {{ $pplp->cabor->nama }}
                                                                                                </a>
                                                                                            </h6>
                                                                                        @empty

                                                                                        @endforelse

                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        @foreach ($atlet->sekolahPada($sekolah->id) as $sekolah)
                                                                                            <h6>
                                                                                                {{ Helper::monthYear($sekolah->pivot->tahun_mulai) }}
                                                                                                ~
                                                                                                {{ !empty($sekolah->pivot->tahun_selesai) ? Helper::monthYear($sekolah->pivot->tahun_selesai) : 'Belum diisi' }}
                                                                                            </h6>
                                                                                        @endforeach
                                                                                    </td>
                                                                                    {{-- <h5>{{$atlet->sekolahs->pivot->tahun_mulai}}</h5> --}}
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        Masuk kelas:
                                                                                        {{ $sekolah->pivot->masuk_kelas }}
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    {{ $sekolah->kelas(request()->input('dari'), request()->input('sampai')) }}
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">Tidak ada atlet untuk cabang olahraga
                                            {{ $cabor->nama }}</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
