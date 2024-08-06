<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SDN000000 | {{ $title }}</title>
        {{-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> --}}

        {{-- Bootstrap@5.3.3 CSS Framework --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
        {{-- Google Icons @SymbolsOutlined --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        
        {{-- Google Fonts @Anta --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        
        {{-- Style --}}
        <style>
            *{
                font-family: 'Roboto', sans-serif;
            }
            ::-webkit-scrollbar{
                display: none
            }
            body{
                height: 100vh;
                overscroll-behavior: none;
            }
            .imageCanvas{
                width: 120px;
                height: 120px;
                background-size: cover;
                background-position: center;
            }
            .userImage{
                height: 32px;
                width: 32px;
                background: url("{{ Auth::user()->image ? asset('storage/Collections/'.Auth::user()->image) : asset('assets/img/person_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.png') }}");
                background-size: cover;
                background-position: center;
            }
        </style>
        @yield('style')
    </head>
    <body>
        <div class="position-relative container-fluid h-100">
            <div class="row h-100">
                <x-sidebar></x-sidebar>
                <main class="col-12 col-md-9 col-xl-10 col-xxl-10 d-flex flex-column h-100">
                    <x-header :title="$title"></x-header>
                    <div class="position-relative row flex-fill overflow-y-auto">
                        @if (session('response'))
                        <x-alert :type="session('response')['type']">{{ session('response')['message'] }}</x-alert>
                        @endif

                        @yield('contents')
                    </div>
                </main>
            </div>
        </div>

        {{-- jQuery@3.7.1 JS Libraries --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        {{-- Bootstrap@5.3.3 Bundle JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        
        {{-- Script for Mobile Sidebar --}}
        <script>
            $(document).ready(function(){
                @if (session('response'))
                const alertAC = new bootstrap.Alert("#alertPanel");
                setTimeout(() => {
                    alertAC.close();
                }, 3000);
                @endif

                $(".btn[data-toggle]").click(function(){
                    let i = $(this).attr('data-toggle');
                    let x = $(i);
                    
                    if(x.parents('.m-sidebar').hasClass('d-none')){
                        x.parents('.m-sidebar').removeClass('d-none');
                    } else{
                        x.parents('.m-sidebar').addClass('d-none');
                    }
                });
            });
        </script>

        @yield('scripts')
    </body>
</html>