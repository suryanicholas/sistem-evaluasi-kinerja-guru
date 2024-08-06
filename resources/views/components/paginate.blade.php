<div class="container-fluid">
    <div class="row mx-2 mb-2 py-2 bg-light justify-content-center align-items-center rounded shadow border">
        <div class="col-1 d-flex justify-content-center">
            <a href="{{ $pages->previousPageUrl() == '' ? '#' : $pages->previousPageUrl() }}" class="btn btn-dark p-0 d-flex">
                <span class="material-symbols-outlined fs-3">chevron_left</span>
            </a>
        </div>
        <div class="col-auto d-flex align-items-center justify-content-center gap-3">
            @php
                $half = floor(9 / 2);
                $start = max($pages->currentPage() - $half, 1);
                $end = min($start + 8, $pages->lastPage());

                $start = max(min($start, $pages->lastPage() - 8), 1);
            @endphp
            @for ($i = $start; $i <= $end; $i++)
            <a href="{{ $i != $pages->currentPage() ? $pages->url($i) : "#" }}" class="nav-link {{ $i == $pages->currentPage() ? '' : 'link-secondary' }} px-1 d-flex justify-content-center align-items-center">{{ $i }}</a>
            @endfor
        </div>
        <div class="col-1 d-flex justify-content-center">
            <a href="{{ $pages->nextPageUrl() == '' ? '#' : $pages->nextPageUrl() }}" class="btn btn-dark p-0 d-flex">
                <span class="material-symbols-outlined fs-3">chevron_right</span>
            </a>
        </div>
    </div>
</div>