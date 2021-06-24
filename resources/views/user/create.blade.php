@extends('template.master')
@section('title', 'Tambah User')
@section('content')
<div class="container">
    <div class="card shadow-sm border">
        <div class="card-header">
            <h2>Tambah Super User</h2>
        </div>
        <div class="card-body p-3">
            <form class="row g-3" method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="col-md-12">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" " id=" email"
                        name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class=" col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" " id="
                        password" name="password" value="{{ old('password') }}">
                    @error('password')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-light shadow-sm border w-100">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
