<div class="m-sidebar position-absolute d-none d-md-none container-fluid h-100 start-0 d-flex flex-column z-1">
    <div class="row h-100 justify-content-end">
        <div class="d-block col-sm-6 col-lg-3 col-xl-2 col-xxl-2 p-0 h-100 overflow-hidden">
            <aside class="h-100 d-flex flex-column bg-dark border-start border-secondary shadow" data-visible="false" id="sidebar">
                <div class="container-fluid position-relative py-3 d-flex align-items-center gap-3 border-bottom border-secondary">
                    <div class="nav-item d-flex align-items-center d-md-none">
                        <button type="button" class="btn p-1 btn-dark d-flex" data-toggle="#sidebar">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="vr text-light d-md-none me-auto"></div>
                    {{-- <div class="nav-item d-block d-sm-none">
                        <a href="#" class="btn btn-dark p-1 d-flex position-relative">
                            <span class="material-symbols-outlined">notifications</span>
                            <span class="position-absolute top-100 start-100 translate-middle badge rounded-pill text-danger">99</span>
                        </a>
                    </div>
                    <div class="nav-item d-block d-sm-none">
                        <a href="#" class="btn btn-dark p-1 d-flex position-relative">
                            <span class="material-symbols-outlined">mail</span>
                            <span class="position-absolute top-100 start-100 translate-middle badge rounded-pill text-danger">99</span>
                        </a>
                    </div> --}}
                    <div class="nav-item d-block d-md-none">
                        <a href="{{ route('profile.edit') }}" class="btn btn-dark d-flex align-items-center p-1">
                            <div class="userImage rounded-circle me-2 border border-3 border-{{ $authority[Auth::user()->role] }} bg-secondary"></div>
                            <span class="ps-2 d-none d-sm-block">{{ Str::limit(Auth::user()->name, 15) }}</span>
                        </a>
                    </div>
                </div>
                <div class="container-fluid flex-fill overflow-hidden">
                    <x-snavbar></x-snavbar>
                </div>
                <div class="container-fluid py-3 border-top border-secondary">
                    {{-- <div class="nav-item mb-2">
                        <a href="#" class="btn btn-dark p-1 ps-2 d-flex gap-2 link-light text-truncate">
                            <span class="material-symbols-outlined">settings</span>
                            Setting
                        </a>
                    </div> --}}
                    <div class="nav-item mb-2">
                        <a href="{{ route('logout') }}" class="btn btn-danger p-1 ps-2 d-flex gap-2 link-light text-truncate">
                            <span class="material-symbols-outlined">logout</span>
                            Sign Out
                        </a>
                    </div>
                    {{-- <div class="nav-item">
                        <a href="#" class="btn btn-dark p-0 ps-2 d-flex link-light text-truncate">Report Bug</a>
                    </div> --}}
                </div>
            </aside>
        </div>
    </div>
</div>
<div class="d-none d-md-block col-md-3 col-lg-3 col-xl-2 col-xxl-2 p-0 h-100 overflow-hidden">
    <aside class="h-100 d-flex flex-column bg-dark border-end border-secondary shadow">
        <div class="container-fluid position-relative py-3 d-flex border-bottom border-secondary">
            <a href="{{ route('home') }}" class="nav-link link-light d-flex mx-auto text-truncate">
                {{-- <img src="{{ asset('sample.jpg') }}" alt="" class="border rounded bg-light" height="44px"> --}}
                <span class="px-3 d-flex justify-content-center align-items-center rounded-end fs-4">SDN106821</span>
            </a>
        </div>
        <div class="container-fluid flex-fill overflow-hidden">
            <x-snavbar></x-snavbar>
        </div>
        {{-- <div class="container-fluid py-3 border-top border-secondary">
            <div class="nav-item mb-2">
                <a href="#" class="btn btn-dark p-0 ps-2 d-flex link-light text-truncate">FAQ</a>
            </div>
            <div class="nav-item mb-2">
                <a href="#" class="btn btn-dark p-0 ps-2 d-flex link-light text-truncate">Help Center</a>
            </div>
            <div class="nav-item">
                <a href="#" class="btn btn-dark p-0 ps-2 d-flex link-light text-truncate">Report Bug</a>
            </div>
        </div> --}}
    </aside>
</div>