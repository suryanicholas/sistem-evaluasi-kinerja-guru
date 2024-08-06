@extends('layouts.dashboard')

@section('style')
    <style>
        .image-container{
            width: 240px;
            height: 240px;
            background: center;
            background-size: cover;
        }
    </style>
@endsection

@section('contents')
    <div class="container h-100 d-flex flex-column">
        <div class="row">
            <div class="col-12 py-2 d-flex gap-3 justify-content-start">
                <a href="{{ route('students.index') }}" class="btn btn-secondary px-3 material-symbols-outlined fs-5 p-1">keyboard_backspace</a>
                <div class="vr"></div>
                <a href="{{ route('students.edit', $data->code) }}" class="btn btn-secondary px-3 material-symbols-outlined fs-5 p-1">edit</a>
                <form action="{{ route('students.destroy', $data->code) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger p-1 px-3 material-symbols-outlined fs-5" type="submit">delete</button>
                </form>
            </div>
        </div>
        <div class="container flex-fill overflow-y-auto">
            <div class="row h-100">
                <div class="col-lg-4 py-3 d-flex justify-content-center">
                    <div class="image-container  rounded-circle border border-3 border-dark align-items-start" style="background-image: url('{{ $data->image ? asset('storage/Collections/'.$data->image) : asset('assets/img/person_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.png') }}')"></div>
                </div>
                <div class="col-lg-8 py-3 h-100 overflow-y-auto">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="code" id="code" class="form-control" value="{{ $data->code }}" disabled>
                            <label for="code">NISN</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" disabled>
                            <label for="name">Nama</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="room" id="room" class="form-control" value="{{ $data->room->name }}" disabled>
                            <label for="room">Kelas</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="gender" id="gender" class="form-control" value="{{ $gender[$data->gender] }}" disabled>
                            <label for="gender">Jenis Kelamin</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" name="birthPlace" id="birthPlace" class="form-control" value="{{ $data->birth['place'] }}" disabled>
                                    <label for="birthPlace">Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" name="birthPlace" id="birthPlace" class="form-control" value="{{ $data->birth['date'] }}" disabled>
                                    <label for="birthPlace">Tanggal Lahir</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-3">
                        <span class="fw-bold">Informasi Orang Tua/Wali</span>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" name="fatherName" id="fatherName" class="form-control" value="{{ $data->parents['father']['name'] }}" disabled>
                                    <label for="fatherName">Nama Ayah</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" name="motherName" id="motherName" class="form-control" value="{{ $data->parents['mother']['name'] }}" disabled>
                                    <label for="motherName">Nama Ibu</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" name="fatherJob" id="fatherJob" class="form-control" value="{{ $data->parents['father']['occupation'] }}" disabled>
                                    <label for="fatherJob">Pekerjaan Ayah</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" name="motherJob" id="motherJob" class="form-control" value="{{ $data->parents['mother']['occupation'] }}" disabled>
                                    <label for="motherJob">Pekerjaan Ibu</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="wali" id="wali" class="form-control" value="{{ $data->parents['guardian'] ? $data->parents['guardian'] : "-" }}" disabled>
                            <label for="wali">Wali Siswa</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ $data->parents['contact'] }}" disabled>
                            <label for="phone">Kontak Orang Tua</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="address" id="address" class="form-control" value="{{ $data->address }}" disabled>
                            <label for="address">Alamat</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection