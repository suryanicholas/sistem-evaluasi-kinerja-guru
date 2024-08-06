@extends('layouts.dashboard')

@section('style')
    <style>
        .teacher-image{
            height: 160px;
            width: 160px;
            background-size: cover;
            background-position: center;
        }
        .students-image{
            background-size: cover;
            background-position: center;
        }
    </style>
@endsection

@section('contents')
    <div class="container h-100 d-flex flex-column">
        <div class="row">
            <div class="col-12 py-2 d-flex gap-3 justify-content-start">
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary px-3 material-symbols-outlined fs-5 p-1">keyboard_backspace</a>
                <div class="vr"></div>
                <a href="{{ route('rooms.edit', $data->code) }}" class="btn btn-secondary px-3 material-symbols-outlined fs-5 p-1">edit</a>
                <form action="{{ route('rooms.destroy', $data->code) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger p-1 px-3 material-symbols-outlined fs-5" type="submit">delete</button>
                </form>
            </div>
        </div>
        <div class="container flex-fill overflow-y-auto">
            <div class="row h-100">
                <div class="col-lg-6">
                    <div class="row py-3">
                        <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                            <div class="teacher-image border border-dark border-3 rounded-circle" style="background-image: url('{{ asset('storage/Collections/'.$data->teacher->image) }}')"></div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" placeholder="" disabled>
                                    <label for="name">Kelas</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" name="teacher" id="teacher" class="form-control" value="{{ $data->teacher->name }}" placeholder="" disabled>
                                    <label for="teacher">Wali Kelas</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="text" name="students" id="students" class="form-control" value="{{ $data->student->count() }}" placeholder="" disabled>
                                    <label for="students">Jumlah Siswa</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 h-100 py-2 d-flex flex-column gap-2 overflow-y-auto">
                    @foreach ($data->student as $item)
                    <a class="nav-link" href="{{ route('students.show', $item->code) }}">
                        <div class="row">
                            <div class="col-2 col-sm-1 pe-0 d-flex">
                                <div class="students-image bg-secondary rounded-start container" style="background-image: url('{{ $item->image ? asset('storage/Collections/'.$item->image) : asset('assets/img/person_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.png') }}')"></div>
                            </div>
                            <div class="col-2 col-sm-1 px-0">
                                <input type="text" name="students" value="{{ $loop->iteration }}" class="form-control rounded-0 fw-bold text-center" placeholder="" disabled>
                            </div>
                            <div class="col-8 col-sm-10 ps-0">
                                <input type="text" name="students" value="{{ $item->name }}" class="form-control rounded-0 rounded-end" placeholder="" disabled>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection