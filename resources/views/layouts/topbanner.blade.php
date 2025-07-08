<div class="border-t-2 border-b-1 border-t-amber-300 border-b-amber-950 bg-amber-400 
            w-full h-[43px]">
    <!--WEATHER MODULE-->
    <div class="flex justify-center relative">
        <img class="z-2 w-[230px] md:w-[310px] " src="{{asset('site/circle2-sm.png')}}">
        <img class="absolute rounded-full w-[80px] top-[30px] md:w-[110px] md:top-[40px]"src="{{asset('site/sun.png')}}">
    </div>
    @if(Auth::user())
    <!--PLAYER DATA-->
    <div class="absolute right-[10px] top-[60px] flex flex-col gap-4 md:top-[50px]  lg:flex-row md:p-2 md:right-0">
        <!--MONEY DISPLAY-->
        <div class="bg-white w-[90px] md:w-[150px] rounded-2xl flex justify-between items-center pe-2">
            <img class="w-[20px] md:w-[40px] -mt-3 -ms-1" src="{{asset('site/coiny2.png')}}">
            <span class='text-xs md:text-base'>{{Auth::user()->ponygold}}</span>
        </div>
        <!--CRYSTAL HEART DISPLAY-->
        <div class="bg-white w-[90px] md:w-[150px] rounded-2xl flex justify-between items-center pe-2 ">
            <img class="w-[20px] md:w-[40px] -mt-3 -ms-1"src="{{asset('site/crystalheart2.png')}}">
            <span class='text-xs md:text-base'>{{Auth::user()->crystalheart}}</span>
        </div>
    </div>
    @endif
<div>
    

</div>