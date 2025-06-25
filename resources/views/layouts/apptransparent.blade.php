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

        <div class='w-full relative md:w-3/4  md:rounded-4xl p-4 pt-[50px] md:mx-auto'>
        <div class='float absolute left-0 -top-[70px] md:-left-[70px] md:-top-[90px] '>
            <span class='page text-3xl md:text-5xl'>@yield('page-title')</span>
            <img class=" w-[150px] md:w-[200px] -mt-8 md:-mt-10" src="{{asset('site/cloud.png')}}">
        </div>
        
        @yield('page-content')

        </div>

    </div>
    <div class="h-[150px]">
    </div>

    @include('layouts.bottombanner')


    
</body>
</html>