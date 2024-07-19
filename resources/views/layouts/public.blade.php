<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <style>
            ::-webkit-scrollbar{
                display: none;
            }
            body{
                width: 100vw;
                height: 100vh;
                overscroll-behavior: none
            }

            main.contents{
                scroll-behavior: smooth;
            }

            .welcome.container h1{
                font-size: 54px
            }
        </style>
        @yield('styles')
    </head>
    <body>
        <div class="container-fluid h-100 d-flex flex-column p-0">
            <header class="text-bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-auto d-flex align-items-center">
                            <a class="nav-link fs-4" href="/">SDN 1068212</a>
                        </div>
                        <div class="col-auto ms-auto">
                            <nav class="navbar">
                                {{-- Default | Navigasi untuk Tata Usaha --}}
                                <div class="nav-item d-flex">
                                    <a href="/signin" class="btn btn-secondary p-1 d-flex">
                                        <span class="material-symbols-outlined">shield_person</span>
                                    </a>
                                </div>

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
            <main class="contents flex-fill overflow-y-auto">
                {{-- <div class="welcome container h-100 d-flex align-items-center justify-content-center">
                    <div class="row">
                        <div class="col text-center">
                            <h1>Selamat Datang</h1>
                            <a href="#identifyForm" class="btn btn-primary p-1 mt-3">Mulai Evaluasi</a>
                            <div class="small mt-1 text-secondary">
                                <span class="material-symbols-outlined">expand_circle_down</span>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div id="identifyForm" class="container h-100">
                    <div class="position-relative row h-100 align-items-center">
                        <div class="col-6 mx-auto position-relative z-0">
                            <div class="mb-3 fs-5 text-center">
                                <span>Kami perlu mengidentifikasi diri anda sebelum melanjutkan</span>
                            </div>
                            <hr>
                            <form class="mb-3">
                                <div class="input-group">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="identify" id="identify" maxlength="18" required placeholder="Masukkan nomor identitas anda...">
                                        <label for="identify">Nomor Identitas</label>
                                    </div>
                                    <button class="btn btn-primary d-flex align-items-center" type="submit">
                                        <span class="material-symbols-outlined">person_search</span>
                                    </button>
                                </div>
                                <small class="mt-1 text-warning d-flex align-items-center">
                                    <span class="material-symbols-outlined me-1">error</span>
                                    <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde?</span>
                                </small>
                            </form>
                            <small>
                                <div class="fw-bold">Catatan</div>
                                <div class="">
                                    <ul>
                                        <li>Masukkan Nomor Induk Siswa Nasional (NISN) bagi anda yang merupakan seorang siswa/i.</li>
                                        <li>Untuk anda yang merupakan seorang Guru/Staff/Pegawai/Kepala Sekolah, gunakan Nomor Induk Pegawai (NIP).</li>
                                    </ul>
                                </div>
                            </small>
                        </div>
                        <div class="position-absolute col-12 h-100 z-1 mx-auto bg-light">
                            
                        </div>
                    </div>
                </div>
            </main>
        </div>
        {{-- @yield('contents') --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        @yield('scripts')
    </body>
</html>