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
                scroll-snap-type: y mandatory;
            }

            main.contents .container{
                scroll-snap-align: start
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
            @yield('contents')
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        @yield('scripts')
    </body>
</html>