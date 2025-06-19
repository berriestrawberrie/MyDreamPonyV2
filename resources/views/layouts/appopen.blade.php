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


    
</body>
</html>