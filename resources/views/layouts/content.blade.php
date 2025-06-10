<div class='w-full relative  bg-white md:w-3/4 md:shadow-lg md:rounded-4xl p-4 pt-[50px] md:mx-auto'>
    <div class='float absolute left-0 -top-[70px] md:-left-[70px] md:-top-[90px] '>
        <span class='page text-3xl md:text-5xl'>@yield('page-title')</span>
        <img class=" w-[150px] md:w-[200px] -mt-8 md:-mt-10" src="{{asset('site/cloud.png')}}">
    </div>
    
    @yield('page-content')

    </div>