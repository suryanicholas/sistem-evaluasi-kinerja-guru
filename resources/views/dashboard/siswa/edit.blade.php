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
    <form class="container h-100 d-flex flex-column" action="{{ route('students.update', $data->code) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-12 py-2 d-flex gap-3 justify-content-start">
                <a href="{{ route('students.show', $data->code) }}" class="btn btn-secondary px-3 material-symbols-outlined fs-5 p-1">keyboard_backspace</a>
                <div class="vr"></div>
                <button class="btn btn-success p-1 px-3 material-symbols-outlined fs-5" type="submit">save</button>
            </div>
        </div>
        <div class="container flex-fill overflow-y-auto">
            <div class="row h-100">
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
                <div class="col-lg-8 py-3 h-100 overflow-y-auto">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('nisn') border-danger @enderror" name="code" id="code" value="{{ old('code', $data->code) }}" placeholder="">
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
                            <input type="text" class="form-control @error('name') border-danger @enderror" name="name" id="name" value="{{ old('name', $data->name) }}" placeholder="">
                            <label for="name">Nama Siswa</label>
                        </div>
                        @error('name')
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
                        <div class="row gap-3">
                            <div class="col-12 col-lg">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('birthPlace') border-danger @enderror" name="birthPlace" id="birthPlace" value="{{ old('birthPlace', $data->birth['place']) }}" placeholder="">
                                    <label for="birthPlace">Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg">
                                <div class="form-floating">
                                    <input type="date" class="form-control @error('birthDate') border-danger @enderror" name="birthDate" id="birthDate" value="{{ old('birthDate', \Carbon\Carbon::parse($data->birth['date'])->format('Y-m-d')) }}" placeholder="">
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
                        'value' => old('room', $data->room->code),
                        'text' => old('roomName', $data->room->name)]"></x-search-selection>
                    <div class="mb-3">
                        <div class="row gap-3">
                            <div class="col-12 col-lg">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('fatherName') border-danger @enderror" name="fatherName" id="fatherName" value="{{ old('fatherName', $data->parents['father']['name']) }}" placeholder="">
                                    <label for="fatherName">Nama Ayah</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('motherName') border-danger @enderror" name="motherName" id="motherName" value="{{ old('motherName', $data->parents['mother']['name']) }}" placeholder="">
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
                                    <input type="text" class="form-control @error('fatherJob') border-danger @enderror" name="fatherJob" id="fatherJob" value="{{ old('fatherJob', $data->parents['father']['occupation']) }}" placeholder="">
                                    <label for="fatherJob">Pekerjaan Ayah</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('motherJob') border-danger @enderror" name="motherJob" id="motherJob" value="{{ old('motherJob', $data->parents['mother']['occupation']) }}" placeholder="">
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
                            <input type="text" class="form-control @error('wali') border-danger @enderror" name="wali" id="wali" value="{{ old('wali', $data->parents['guardian']) }}" placeholder="">
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
                            <input type="text" class="form-control @error('phone') border-danger @enderror" name="phone" id="phone" value="{{ old('phone', $data->parents['contact']) }}" placeholder="">
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
                            <input type="text" class="form-control @error('address') border-danger @enderror" name="address" id="address" value="{{ old('address', $data->address) }}" placeholder="">
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
        </div>
    </form>
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