@extends('layouts.dashboard')

@section('contents')
    <div class="container h-100 d-flex flex-column">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 py-3">
                <form class="p-3 border rounded shadow text-secondary" method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('nisn') border-danger @enderror" name="code" id="code" value="{{ old('code') }}" placeholder="">
                            <label for="code">Nomor Induk Siswa Nasional (NISN)</label>
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
                            <input type="text" class="form-control @error('name') border-danger @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="">
                            <label for="name">Nama Siswa</label>
                        </div>
                        @error('name')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">Jenis Kelamin</div>
                        </div>
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
                        <div class="row gap-3">
                            <div class="col-12 col-lg">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('birthPlace') border-danger @enderror" name="birthPlace" id="birthPlace" value="{{ old('birthPlace') }}" placeholder="">
                                    <label for="birthPlace">Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg">
                                <div class="form-floating">
                                    <input type="date" class="form-control @error('birthDate') border-danger @enderror" name="birthDate" id="birthDate" value="{{ old('birthDate', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}" placeholder="">
                                    <label for="birthDate">Tanggal Lahir</label>
                                </div>
                            </div>
                            @if ($errors->has('birthPlace'))
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $errors->first('birthPlace') }}
                            </small>
                            @elseif ($errors->has('birthDate'))
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $errors->first('birthDate') }}
                            </small>
                            @endif
                        </div>
                    </div>
                    <x-search-selection :config="[
                        'components' => 'view',
                        'options' => $rooms,
                        'name' => 'room',
                        'label' => 'Kelas',
                        'request' => 'rooms',
                        'value' => old('room'),
                        'text' => old('roomName')]"></x-search-selection>
                    <div class="mb-3 position-relative z-0">
                        <div class="row gap-3">
                            <div class="col-12 col-lg">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('fatherName') border-danger @enderror" name="fatherName" id="fatherName" value="{{ old('fatherName') }}" placeholder="">
                                    <label for="fatherName">Nama Ayah</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('motherName') border-danger @enderror" name="motherName" id="motherName" value="{{ old('motherName') }}" placeholder="">
                                    <label for="motherName">Nama Ibu</label>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('fatherName'))
                        <small class="text-danger d-flex align-items-center">
                            <span class="material-symbols-outlined fs-5 pe-1">error</span>
                            {{ $errors->first('fatherName') }}
                        </small>
                        @elseif ($errors->has('motherName'))
                        <small class="text-danger d-flex align-items-center">
                            <span class="material-symbols-outlined fs-5 pe-1">error</span>
                            {{ $errors->first('motherName') }}
                        </small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <div class="row gap-3">
                            <div class="col-12 col-lg">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('fatherJob') border-danger @enderror" name="fatherJob" id="fatherJob" value="{{ old('fatherJob') }}" placeholder="">
                                    <label for="fatherJob">Pekerjaan Ayah</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('motherJob') border-danger @enderror" name="motherJob" id="motherJob" value="{{ old('motherJob') }}" placeholder="">
                                    <label for="motherJob">Pekerjaan Ibu</label>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('fatherJob'))
                        <small class="text-danger d-flex align-items-center">
                            <span class="material-symbols-outlined fs-5 pe-1">error</span>
                            {{ $errors->first('fatherJob') }}
                        </small>
                        @elseif ($errors->has('motherJob'))
                        <small class="text-danger d-flex align-items-center">
                            <span class="material-symbols-outlined fs-5 pe-1">error</span>
                            {{ $errors->first('motherJob') }}
                        </small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('wali') border-danger @enderror" name="wali" id="wali" value="{{ old('wali') }}" placeholder="">
                            <label for="wali">Wali Kelas (Opsional)</label>
                        </div>
                        @error('wali')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('phone') border-danger @enderror" name="phone" id="phone" value="{{ old('phone') }}" placeholder="">
                            <label for="phone">Kontak Orang Tua</label>
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
<x-search-selection :config="['components' => 'script']"></x-search-selection>
@endsection