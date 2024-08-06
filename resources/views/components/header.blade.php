@if (Request::is("dashboard*"))
    <header class="row bg-dark">
        <div class="col d-flex d-md-none py-2">
            <a href="{{ route('home') }}" class="nav-link link-light d-flex text-truncate">
                {{-- <img src="{{ asset('assets/img/sample.jpg') }}" alt="" class="border bg-light rounded" height="44px"> --}}
                <span class="px-3 d-flex justify-content-center align-items-center rounded-end fs-4">SDN106821</span>
            </a>
        </div>
        <div class="col-md-4 col-lg-6 d-none d-md-flex flex-column">
            <div class="row">
                <x-breadcrumb></x-breadcrumb>
            </div>
            <div class="row align-items-center flex-fill">
                <div class="text-light h5 m-0 text-truncate">
                    {{ $title }}
                </div>
            </div>
        </div>
        <div class="col-auto d-flex d-md-flex ms-auto">
            <nav class="d-flex align-items-center gap-3 py-2">
                {{-- <div class="nav-item d-none d-sm-block">
                    <a href="#" class="btn btn-dark p-1 d-flex position-relative">
                        <span class="material-symbols-outlined">post_add</span>
                    </a>
                </div> --}}
                {{-- <div class="vr text-light d-none d-sm-block"></div> --}}
                <div class="nav-item d-flex d-md-none">
                    <button type="button" class="btn btn-dark d-flex" data-toggle="#sidebar">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                </div>
                <div class="nav-item dropdown d-none d-md-block">
                    <a type="button" class="btn btn-dark d-flex align-items-center p-1" data-bs-toggle="dropdown">
                        <div class="userImage rounded-circle me-2 border border-3 border-{{ $authority[Auth::user()->role] }} bg-secondary"></div>
                        {{ Str::limit(Auth::user()->name, 15) }}
                    </a>
                    <div class="dropdown-menu mt-1 dropdown-menu-dark p-2 dropdown-menu-end">
                        <div class="nav-item d-flex mb-3">
                            <a href="{{ route('profile.edit') }}" class="nav-link link-light d-flex align-items-center flex-fill">
                                <span class="material-symbols-outlined me-2">person</span>
                                Profile
                            </a>
                        </div>
                        {{-- <div class="nav-item d-flex mb-3">
                            <a href="#" class="nav-link link-light d-flex align-items-center flex-fill">
                                <span class="material-symbols-outlined me-2">settings</span>
                                Setting
                            </a>
                        </div> --}}
                        <div class="nav-item dropdown-divider"></div>
                        <div class="nav-item d-flex" style="cursor: pointer">
                            <a class="nav-link link-danger d-flex align-items-center flex-fill"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="material-symbols-outlined me-2">logout</span>
                                Log Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
@else
    <header class="text-bg-light">
        <div class="container">
            <div class="row">
                @if (!Request::is('profile*'))
                <div class="col-auto d-flex align-items-center">
                    <a class="nav-link fs-4" href="/">SD Negeri 106821</a>
                </div>
                @endif
                <div class="col-auto ms-auto">
                    <nav class="navbar">
                        {{-- Default | Navigasi untuk Tata Usaha --}}
                        @if (Auth::user())
                        <div class="nav-item d-flex">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary p-1 d-flex">
                                <span class="material-symbols-outlined">shield_person</span>
                            </a>
                        </div>
                        @else
                        <div class="nav-item d-flex">
                            <a href="{{ route('login') }}" class="btn btn-secondary p-1 d-flex">
                                <span class="material-symbols-outlined">shield_person</span>
                            </a>
                        </div>
                        @endif

                        {{-- Setelah Konfirmasi | Navigasi keluar untuk yang mengevaluasi (Siswa/Orang Tua dan Sejawat) --}}
                        {{-- <div class="nav-item d-flex align-items-center text-bg-dark rounded">
                            <span class="px-2">Agustaria Br Bangun</span>
                            <a href="/signin" class="btn btn-danger p-1 d-flex">
                                <span class="material-symbols-outlined">logout</span>
                            </a>
                        </div> --}}
                    </nav>
                </div>
            </div>
        </div>
    </header>
@endif
