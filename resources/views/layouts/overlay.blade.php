<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
</head>
<body class="relative h-screen bg-sky-300">

    <div class="min-w-screen min-h-screen bg-stone-800/85 fixed top-0 left-0 z-50">
        @yield('overlay-content')
        @include('layouts.closeoverlay')
    </div>
    @include('layouts.topbanner')

    @include('layouts.foreground')
    <div class='w-full flex'>



    </div>
    <div class="h-[150px]">
    </div>

    @include('layouts.bottombanner')

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    
</body>
</html>