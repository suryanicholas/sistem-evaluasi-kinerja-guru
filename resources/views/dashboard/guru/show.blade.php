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
                <a href="{{ route('teachers.index') }}" class="btn btn-secondary px-3 material-symbols-outlined fs-5 p-1">keyboard_backspace</a>
                <div class="vr"></div>
                <a href="{{ route('teachers.edit', $data->code) }}" class="btn btn-secondary px-3 material-symbols-outlined fs-5 p-1">edit</a>
                <form action="{{ route('teachers.destroy', $data->code) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger p-1 px-3 material-symbols-outlined fs-5" type="submit">delete</button>
                </form>
            </div>
            <div class="col-lg-4 py-3 d-flex justify-content-center">
                <div class="image-container  rounded-circle border border-3 border-dark align-items-start" style="background-image: url('{{ $data->image ? asset('storage/Collections/'.$data->image) : asset('assets/img/person_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.png') }}')"></div>
            </div>
            <div class="col-lg-8 py-3">
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" disabled>
                        <label for="name">Nama</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="alias" id="alias" class="form-control" value="{{ $data->alias }}" disabled>
                        <label for="alias">Alias</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="code" id="code" class="form-control" value="{{ $data->code }}" disabled>
                        <label for="code">NIP</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="gender" id="gender" class="form-control" value="{{ $gender[$data->gender] }}" disabled>
                        <label for="gender">Jenis Kelamin</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="teaching" id="teaching" class="form-control" value="{{ $data->teaching }}" disabled>
                        <label for="teaching">Bidang Studi</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="email" id="email" class="form-control" value="{{ $data->email }}" disabled>
                        <label for="email">Alamat Email</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $data->phone }}" disabled>
                        <label for="phone">Kontak</label>
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
@endsection