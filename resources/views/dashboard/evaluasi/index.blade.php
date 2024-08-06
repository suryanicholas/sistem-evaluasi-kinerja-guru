@extends('layouts.dashboard')

@section('contents')
    <div class="container h-100 d-flex flex-column">
        <x-toolbar :require="[
            'route' => [
                'destroy' => false,
                'create' => route('evaluations.create')
            ],
            'search' => false
        ]"></x-toolbar>
        <div class="container-fluid py-3 flex-fill overflow-y-auto">
            @for ($i = 1; $i <= 20; $i++)
            <div class="row bg-light border rounded shadow overflow-hidden mb-3">
                <div class="col-2 col-lg-1 d-flex align-items-center justify-content-center text-bg-secondary">
                    <span class="fw-bold">{{ $i }}</span>
                </div>
                <div class="col-10 col-lg-11">
                    <div class="row">
                        <div class="col-lg-12 text-truncate">
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis magnam quod ipsum eaque voluptatibus, cumque iste eos vero qui possimus inventore ratione, provident quidem pariatur. Voluptate unde corrupti veniam beatae.</span>
                        </div>
                        <div class="col-6 col-lg-3">
                            <small class="text-secondary">Responden</small>
                            <div class="text-truncate">99</div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <small class="text-secondary">Menyelesaikan</small>
                            <div class="text-truncate">99</div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <small class="text-secondary">Berakhir</small>
                            <div class="text-truncate">02 Agustus 2024</div>
                        </div>
                        <div class="col-12 col-lg-3 d-flex align-items-center gap-2">
                            <a href="#" class="btn p-1 fs-5 btn-light material-symbols-outlined">monitoring</a>
                            <a href="#" class="btn p-1 fs-5 btn-light material-symbols-outlined">edit</a>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        <x-paginate :paginateContent="$data"></x-paginate>
    </div>
@endsection