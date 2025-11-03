<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
</head>
<body class="relative h-screen bg-sky-300 overflow-x-hidden">

    <!-- Top Banner: Reserve height to prevent shift -->
    <div class="w-full min-h-[100px]">
        @include('layouts.topbanner')
    </div>

    <!-- Foreground: Ensure consistent height if animated -->
    <div class="w-full min-h-[200px]">
        @include('layouts.foreground')
    </div>

    <!-- Alerts: Reserve space even if empty -->
    <div class="w-full min-h-[60px]">
        @include('layouts.alerts')
    </div>

    <!-- Main Content -->
    <div class="w-full flex min-h-[calc(100vh-310px)]" id="content-area">
    <!--PARTIALS GO HERE-->
    {!! $content ?? '' !!}
        @yield('content')
    </div>

    <!-- Spacer to prevent bottom banner overlap -->
    <div class="h-[150px]"></div>

    <!-- Bottom Banner -->
    <div class="w-full min-h-[100px]">
        @include('layouts.bottombanner')
    </div>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <script type="text/javascript" src="{{ asset('js/stables.js') }}">
    </script>
</body>
</html>