@extends('layouts.profile')

@section('styles')
    <style>
        .image-container{
            width: 240px;
            height: 240px;
            background-image: url('{{ $user->image ? asset("storage/Collections/".$user->image) : asset("assets/img/person_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.png") }}');
            background-size: cover;
            background-position: center;
            cursor: pointer;
        }
        .nav-link:hover{
            background: lightgrey;
        }
        .nav-link.active{
            background: lightgrey;
        }
    </style>
@endsection

@section('contents')
<main class="contents flex-fill overflow-y-auto">
    <div class="row h-100">
        <div class="col-lg-2 small overflow-auto border-end border-2">
            <div class="row mt-3 mb-1">
                <div class="col fw-bold">
                    Umum
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <a href="#" class="nav-link ps-2 active">Profil</a>
                </div>
            </div>
            <div class="row mt-3 mb-1">
                <div class="col fw-bold">
                    Akses
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <a href="#" class="nav-link ps-2">Kata Sandi</a>
                </div>
            </div>
        </div>
        <div class="col-lg position-relative">
            <div class="row">
                @if (session('response'))
                <x-alert :type="session('response')['type']">{{ session('response')['message'] }}</x-alert>
                @endif
            </div>
            <form class="row justify-content-center position-relative z-0" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="col-lg-4 py-3 d-flex flex-column align-items-center">
                    <label for="image" id="imagePreview" class="image-container rounded-circle border border-3 border-dark align-items-start"></label>
                    <input type="file" accept=".jpg, .jpeg, .png" onchange="previewImage(event)" class="form-control d-none @error('image') border-danger @enderror" name="image" id="image" placeholder="">
                    @error('image')
                        <small class="text-danger d-flex align-items-center">
                            <span class="material-symbols-outlined fs-5 pe-1">error</span>
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-lg-6 py-3">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="username" id="username" value="{{ $user->username }}" class="form-control" placeholder="">
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
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" placeholder="">
                            <label for="name">Nama</label>
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
                            <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control" placeholder="">
                            <label for="email">Nama</label>
                        </div>
                        @error('email')
                        <small class="text-danger d-flex align-items-center">
                            <span class="material-symbols-outlined fs-5 pe-1">error</span>
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="mb-3 text-end">
                        <button class="btn btn-success" type="submit">Perbarui</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    var oldImage = "{{ $user->image ? asset('storage/Collections/'.$user->image) : asset('assets/img/person_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.png') }}";
    
    function previewImage(event) {
        var reader = new FileReader();
        var output = document.getElementById('imagePreview');
        reader.onload = function() {
            output.style.backgroundImage = `url(${reader.result})`;
        }
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        } else {
            output.style.backgroundImage = `url(${oldImage})`;
        }
    }
</script>
@endsection