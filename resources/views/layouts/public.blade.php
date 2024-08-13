<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>
        <link rel="shortcut icon" href="{{ asset('assets/img/favicon.svg') }}" type="image/x-icon">
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
        </style>
        @yield('styles')
    </head>
    <body>
        <div class="position-relative container-fluid h-100 d-flex flex-column p-0">
            @if (session('response'))
            <x-alert :type="session('response')['type']">{{ session('response')['message'] }}</x-alert>
            @endif
            @yield('contents')
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            @if (session('response'))
            const alertAC = new bootstrap.Alert("#alertPanel");
            setTimeout(() => {
                alertAC.close();
            }, 3000);
            @endif
            var s = true;
            $('a[href*="#"]').click(function (e) { 
                e.preventDefault();

                if(s){
                    s = false;
                    $("main.contents").css("scroll-snap-type", "none");
                    $("main.contents").animate({
                        scrollTop: $(this.hash).offset().top
                    }, 800, function(){
                        $("main.contents").css("scroll-snap-type", "y mandatory");
                        s = true;
                    });
                }
            });
        </script>
        @yield('scripts')
    </body>
</html>