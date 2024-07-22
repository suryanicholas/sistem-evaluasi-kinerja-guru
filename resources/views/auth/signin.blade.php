@extends('layouts.auth')

@section('contents')
<div class="container-fluid h-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center rounded overflow-hidden">
            <div class="col d-none bg-light d-lg-flex flex-column align-items-center justify-content-center">
                <div class="text-secondary fs-5">Sistem Evaluasi Kinerja</div>
                <div class="h1">SDN 1068212</div>
                <div class="h5">Bandar Baru</div>
            </div>
            <div class="col col-lg-5 bg-light-subtle py-3">
                <div class="h4 text-center mb-3">
                    <span>Silahkan Masuk</span>
                </div>
                <form class="mx-4" method="post" action="{{ route('signin') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" value="{{ old('username') }}" name="username" maxlength="33" placeholder="Nama Pengguna" required>
                        <label for="username">Nama Pengguna</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" required>
                        <label for="password">Kata Sandi</label>
                        @error('username')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection