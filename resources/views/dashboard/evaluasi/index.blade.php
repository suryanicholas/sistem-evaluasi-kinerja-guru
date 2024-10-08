@extends('layouts.dashboard')

@section('contents')
    <div class="container h-100 d-flex flex-column">
        <x-toolbar :require="[
            'route' => [
                'destroy' => false,
                'create' => false
            ],
            'search' => false
        ]">
            <form action="{{ route('evaluations.store') }}" method="post">
                @csrf
                <button class="btn btn-primary p-1 material-symbols-outlined" type="submit">add</button>
            </form>
        </x-toolbar>
        <div class="container-fluid py-3 flex-fill overflow-y-auto">
            @foreach ($data as $item)
            <div class="row bg-light border rounded mb-3 overflow-auto">
                <div class="col-lg-1 d-flex align-items-center justify-content-center fw-bold text-bg-secondary">
                    <span>{{ $loop->iteration }}</span>
                </div>
                <div class="col-lg-11">
                    <div class="row">
                        <div class="col-lg-12 text-truncate">
                            <span>{{ $item->title }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-auto me-auto text-secondary d-flex align-items-center gap-1">
                            <a href="{{ route('evaluations.show', $item->slug) }}" class="btn btn-light fs-5 p-2 material-symbols-outlined">monitoring</a>
                            <a href="{{ route('evaluations.edit', $item->slug) }}" class="btn btn-light fs-5 p-2 material-symbols-outlined">edit</a>
                            <form action="{{ route('evaluations.destroy', $item->slug) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-light fs-5 p-2 material-symbols-outlined">delete</button>
                            </form>
                            <a href="{{ route('evaluate.index', $item->slug) }}" target="_blank" class="btn btn-light fs-5 p-2 material-symbols-outlined">open_in_new</a>
                            <button type="button" class="linkCopy btn btn-light fs-5 p-2 material-symbols-outlined">link</button>
                        </div>
                        <div class="col-lg-3 text-secondary">
                            <small>Responden</small>
                            <div>{{ $item->respondent->count() }}</div>
                        </div>
                        <div class="col-lg-3 text-secondary">
                            <small>Berakhir</small>
                            <div>{{ $item->periode ? \Carbon\Carbon::parse(json_decode($item->periode)->end)->locale('id')->translatedFormat('d F Y') : '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <x-paginate :paginateContent="$data"></x-paginate>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            let x = true;
            $('.linkCopy[type="button"]').click(function (){
                if(x){
                    navigator.clipboard.writeText($(this).prev().attr('href'));

                    x = false;
                    
                    if($(this).hasClass('btn-light')){
                        $(this).removeClass('btn-light');
                        $(this).addClass('btn-success');
                    }

                    setTimeout(() => {
                        $(this).removeClass('btn-success');
                        $(this).addClass('btn-light');
                        x = true;
                    }, 100);
                }
            });
        });
    </script>
@endsection