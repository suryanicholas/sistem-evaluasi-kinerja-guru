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
                <a href="{{ route('users.index') }}" class="btn btn-secondary px-3 material-symbols-outlined fs-5 p-1">keyboard_backspace</a>
                <div class="vr"></div>
                {{-- <a href="#" class="btn btn-secondary px-3 material-symbols-outlined fs-5 p-1">edit</a> --}}
                <form action="{{ route('users.destroy', $data->username) }}" method="POST">
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
                        <input type="text" name="username" id="username" class="form-control" value="{{ $data->username }}" disabled>
                        <label for="username">Username</label>
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
                        <input type="text" name="email" id="email" class="form-control" value="{{ $data->email }}" disabled>
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="role" id="role" class="form-control" value="{{ Str::ucfirst($data->role) }}" disabled>
                        <label for="role">Otoritas</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="text" name="registered_at" id="registered_at" class="form-control" value="{{ \Carbon\Carbon::parse($data->created_at)->format('d F Y') }}" disabled>
                        <label for="registered_at">Bergabung pada</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection