<div class="position-relative z-0 container-fluid">
    <div class="row mx-2 mt-2 py-2 bg-light border rounded shadow">
        <div class="col">
            @if ($requires['search'])
            <form action="">
                <div class="input-group">
                    <button class="btn p-1 btn-primary d-flex" type="submit">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                    <input class="form-control p-1" type="search" name="search" placeholder="Enter keywords...">
                    @if ($requires['search']['filter'])
                    <button class="btn p-1 btn-secondary d-flex" type="button">
                        <span class="material-symbols-outlined">tune</span>
                    </button>
                    @endif
                </div>
            </form>
            @endif
        </div>
        <div class="col-auto col-sm-2 col-md-4 col-lg-6 d-flex">
            <nav class="d-flex gap-2 ps-auto ms-auto">
                @if ($requires['route']['destroy'])
                <form action="{{ $requires['route']['destroy'] }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="nav-item ms-auto">
                        <button class="btn p-1 btn-danger d-flex" type="submit">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </div>
                </form>
                @endif
                @if ($requires['route']['create'])
                <div class="nav-item">
                    <a href="{{ $requires['route']['create'] }}" class="btn p-1 btn-success d-flex">
                        <span class="material-symbols-outlined">add</span>
                    </a>
                </div>
                @endif
            </nav>
        </div>
    </div>
</div>