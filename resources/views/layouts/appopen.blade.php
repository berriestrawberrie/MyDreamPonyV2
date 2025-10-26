<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
</head>
<body class="relative h-screen bg-sky-300">
    
    @include('layouts.topbanner')

    @include('layouts.foreground')

    @include('layouts.alerts')
    <div class='w-full flex'>

        @include('layouts.contentopen')

    </div>
    <div class="h-[150px]">
    </div>

    @include('layouts.bottombanner')

    <!--SCREEN LOADING ANIMATOR-->
    <script>
    window.addEventListener('load', () => {
        const loader = document.getElementById('loading-screen');
        loader.style.display = 'none';
    });
    </script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    
</body>
</html>