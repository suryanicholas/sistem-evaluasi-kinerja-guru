@extends('layouts.auth')

@section('contents')
<div class="container-fluid h-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center rounded overflow-hidden">
            <div class="col col-lg-5 bg-light-subtle py-3">
                <div class="h4 text-center mb-3">
                    <span>Buat Akun</span>
                </div>
                <form class="mx-4" method="post" action="{{ route('users.store') }}">
                    @csrf
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name" maxlength="33" placeholder="Nama Lengkap" required>
                            <label for="name">Nama Lengkap</label>
                        </div>
                        @error('name')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" value="{{ old('username') }}" name="username" maxlength="33" placeholder="Nama Pengguna" required>
                            <label for="username">Nama Pengguna</label>
                        </div>
                        @error('username')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" value="{{ old('email') }}" name="email" maxlength="33" placeholder="Nama Pengguna" required>
                            <label for="email">Email</label>
                        </div>
                        @error('email')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" required>
                            <label for="password">Kata Sandi</label>
                        </div>
                        @error('password')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation" placeholder="Kata Sandi" required>
                            <label for="passwordConfirmation">Konfirmasi Kata Sandi</label>
                        </div>
                        @error('password_confirmation')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
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