@extends('template.master')
@section('title', 'Tambah Atlet ke Prestasi')
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
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Tambah Atlet ke Prestasi
                        </h5>
                    </div>
                    <div class="card-body">
                        List Atlet pada ({{ $prestasi->judul }}):
                        <ul>
                            @forelse ($prestasi->atlets as $atlet)
                                <li>
                                    {{ $atlet->user->name }}
                                </li>
                            @empty
                                Tidak terdapat atlet
                            @endforelse
                        </ul>
                        <hr>
                        <form class="row g-3" method="POST"
                            action="{{ route('prestasi.atlet.store', compact('prestasi')) }}">
                            @csrf
                            <div class=" col-md-12">
                                <label for="atlet_id" class="form-label">Tambah Atlet</label>
                                <select id="atlet_id" name="atlet_id"
                                    class="form-select @error('password') is-invalid @enderror select2">
                                    <option selected disabled hidden>Choose...</option>
                                    @forelse ($atlets as $atlet)
                                        <option value="{{ $atlet->id }}" @if (old('atlet_id') == $atlet->id) selected @endif>{{ $atlet->user->name }}</option>
                                    @empty
                                        Tidak ada atlet
                                    @endforelse
                                </select>
                                @error('atlet_id')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-light shadow-sm border float-end">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.select2').select2();

    </script>
@endsection
