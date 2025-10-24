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

        @include('layouts.content')

    </div>
    <div class="h-[150px]">
    </div>

    @include('layouts.bottombanner')


    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>