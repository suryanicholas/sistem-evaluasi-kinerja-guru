@extends('layouts.dashboard')

@section('style')
    <style>
        .image-container{
            width: 240px;
            height: 240px;
            background: center;
            background-size: cover;
            cursor: pointer;
        }
    </style>
@endsection

@section('contents')
    <div class="container h-100 d-flex flex-column">
        
        <form action="{{ route('teachers.update', $data->code) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-12 py-2 d-flex gap-3 justify-content-start">
                    <a href="{{ route('teachers.show', $data->code) }}" class="btn btn-secondary px-3 material-symbols-outlined fs-5 p-1">keyboard_backspace</a>
                    <div class="vr"></div>
                    <button class="btn btn-success p-1 px-3 material-symbols-outlined fs-5" type="submit">save</button>
                </div>
                <div class="col-lg-4 py-3 d-flex flex-column align-items-center">
                    <label for="image" id="imagePreview" class="image-container rounded-circle border border-3 border-dark align-items-start" style="background-image: url('{{ $data->image ? asset('storage/Collections/'.$data->image) : asset('assets/img/person_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.png') }}')"></label>
                    <input type="file" accept=".jpg, .jpeg, .png" onchange="previewImage(event)" class="form-control d-none @error('image') border-danger @enderror" name="image" id="image" placeholder="">
                    @error('image')
                        <small class="text-danger d-flex align-items-center">
                            <span class="material-symbols-outlined fs-5 pe-1">error</span>
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-lg-8 py-3">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}">
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
                            <input type="text" name="alias" id="alias" class="form-control" value="{{ $data->alias }}">
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
                            <input type="text" name="code" id="code" class="form-control" maxlength="18" value="{{ $data->code }}">
                            <label for="code">Nomor Induk Pegawai (NIP)</label>
                        </div>
                        @error('code')
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
                                    <input type="radio" class="form-check-input" name="gender" value="male" placeholder="" {{ $gender[$data->gender] ? "checked" : "" }}>
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="col-6">
                                <label>
                                    <input type="radio" class="form-check-input" name="gender" value="female" placeholder="" {{ $gender[$data->gender] ? "" : "checked" }}>
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="teaching" id="teaching" class="form-control" value="{{ $data->teaching }}">
                            <label for="teaching">Bidang Studi</label>
                        </div>
                        @error('teaching')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="email" id="email" class="form-control" value="{{ $data->email }}">
                            <label for="email">Alamat Email</label>
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
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ $data->phone }}">
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
                            <input type="text" name="address" id="address" class="form-control" value="{{ $data->address }}">
                            <label for="address">Alamat</label>
                        </div>
                        @error('address')
                            <small class="text-danger d-flex align-items-center">
                                <span class="material-symbols-outlined fs-5 pe-1">error</span>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    var oldImage = "{{ $data->image ? asset('storage/Collections/'.$data->image) : asset('assets/img/person_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.png') }}";
    
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