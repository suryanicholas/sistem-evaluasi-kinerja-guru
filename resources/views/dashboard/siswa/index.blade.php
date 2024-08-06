@extends('layouts.dashboard')

@section('contents')
    <div class="container h-100 d-flex flex-column">
        <x-toolbar :require="[
            'route' => [
                'destroy' => false,
                'create' => route('students.create')
            ],
            'search' => false
        ]"></x-toolbar>
        <div class="container-fluid py-3 flex-fill overflow-y-auto">
            <div class="row">
                @foreach ($data as $item)
                <div class="col-12 col-md-6 col-lg-4 py-2">
                    <div class="container bg-dark-subtle rounded shadow border overflow-hidden">
                        <a class="nav-link" href="{{ route('students.show', $item->code) }}">
                            <div class="row">
                                <div class="col-auto p-0 d-flex align-items-center justify-content-center" style="max-height: 80px; max-width: 80px">
                                    <div class="imageCanvas" style="background-image: url('{{ $item->image ? asset('storage/Collections/'.$item->image) : asset('assets/img/person_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.png') }}')"></div>
                                </div>
                                <div class="col-6">
                                    <div class="teacher-name text-truncate">
                                        <span class="fw-bold">{{ $item->name }}</span>
                                    </div>
                                    <div class="teacher-nickname text-truncate text-secondary">
                                        <span>{{ $item->room->name }}</span>
                                    </div>
                                    <div class="teacher-role small text-truncate text-secondary">
                                        <span>{{ $gender[$item->gender] }}</span>
                                    </div>
                                </div>
                                <form class="col-auto ms-auto px-0 d-flex align-items-end" action="{{ route('students.destroy', $item->code) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger p-1" type="submit">
                                        <span class="material-symbols-outlined fs-5 d-flex">delete</span>
                                    </button>
                                </form>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <x-paginate :paginateContent="$data"></x-paginate>
    </div>
@endsection