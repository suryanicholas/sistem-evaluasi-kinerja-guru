@extends('layouts.dashboard')

@section('contents')
    <div class="container h-100 d-flex flex-column">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 py-3">
                <form class="p-3 border rounded shadow text-secondary" method="POST" action="{{ route('teachers.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('name') border-danger @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="">
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
                            <input type="text" class="form-control @error('alias') border-danger @enderror" name="alias" id="alias" value="{{ old('alias') }}" placeholder="">
                            <label for="alias">Alias</label>
                        </div> 
                        @error('alias')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('code') border-danger @enderror" name="code" id="code" value="{{ old('code') }}" placeholder="">
                            <label for="code">Nomor Induk Pegawai (NIP)</label>
                        </div>
                        @error('code')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('teaching') border-danger @enderror" name="teaching" id="teaching" value="{{ old('teaching') }}" placeholder="">
                            <label for="teaching">Bidang Studi</label>
                        </div>
                        @error('teaching')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="container mb-3">
                        <div class="row">Jenis Kelamin</div>
                        <div class="row">
                            <div class="col-6">
                                <label>
                                    <input type="radio" class="form-check-input" name="gender" value="male" placeholder="" checked>
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="col-6">
                                <label>
                                    <input type="radio" class="form-check-input" name="gender" value="female" placeholder="">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="email" class="form-control @error('email') border-danger @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="">
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
                            <input type="text" class="form-control @error('phone') border-danger @enderror" name="phone" id="phone" value="{{ old('phone') }}" placeholder="">
                            <label for="phone">Kontak</label>
                        </div>
                        @error('phone')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('address') border-danger @enderror" name="address" id="address" value="{{ old('address') }}" placeholder="">
                            <label for="address">Alamat</label>
                        </div>
                        @error('address')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div id="imagePreview" class="mb-3 text-center"></div>
                        <input type="file" accept=".jpg, .jpeg, .png" onchange="previewImage(event)" class="form-control @error('image') border-danger @enderror" name="image" id="image" placeholder="">
                        @error('image')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.innerHTML = '<img src="' + reader.result + '" class="border" height="160px" alt="Product Image">';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection