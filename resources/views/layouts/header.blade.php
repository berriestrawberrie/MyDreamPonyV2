    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    
    <title>Document</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!--JQUERY UI-->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&family=Eagle+Lake&display=swap" rel="stylesheet">

    <!--FONT AWESOME-->
    <script src="https://kit.fontawesome.com/df8ac4cd23.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">