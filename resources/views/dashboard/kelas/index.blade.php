@extends('layouts.dashboard')

@section('contents')
    <div class="container h-100 d-flex flex-column">
        <x-toolbar :require="[
            'route' => [
                'destroy' => false,
                'create' => route('rooms.create')
            ],
            'search' => false
        ]"></x-toolbar>
        <div class="container-fluid py-3 flex-fill overflow-y-auto">
            <div class="row">
                @foreach ($data as $item)
                <div class="col-12 col-md-6 col-lg-4 py-2">
                    <div class="container bg-dark-subtle rounded shadow border overflow-hidden">
                        <a class="nav-link" href="{{ route('rooms.show', $item->code) }}">
                            <div class="row">
                                <div class="col-3 d-flex p-0 align-items-center justify-content-center text-bg-primary">
                                    <div class="class-label">
                                        <span class="fs-3">{{ $item->name }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="class-teacher text-truncate">
                                        <span class="fw-bold">{{ $item->teacher->name }}</span>
                                    </div>
                                    <div class="class-population text-secondary text-truncate">
                                        <span>{{ $item->student->count() }}</span>
                                        <span>Siswa</span>
                                    </div>
                                </div>
                                <form class="col-auto ms-auto px-0 d-flex align-items-end" action="{{ route('rooms.destroy', $item->code) }}" method="POST">
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