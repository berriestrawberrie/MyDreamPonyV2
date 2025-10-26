<div class="fixed border-t-2 border-b-1 border-t-amber-300 border-b-amber-950 bg-amber-400 
            w-full h-[43px] z-20">
    <!--WEATHER MODULE-->
    <div class="flex justify-center relative">
        <img class="z-2 w-[230px] md:w-[310px] " src="{{asset('site/circle2-sm.png')}}">
        <img class="absolute rounded-full w-[80px] top-[30px] md:w-[110px] md:top-[40px]"src="{{asset('site/sun.png')}}">
    </div>
    @if(Auth::user())
    <!--PLAYER DATA-->
    <div class="absolute right-[60px] -top-[3px] flex flex-col gap-4  lg:flex-row md:p-2">
        <!--MONEY DISPLAY-->
        <div class="bg-white border border-amber-950 w-[90px] md:w-[130px] lg:w-[150px] rounded-2xl flex justify-between items-center pe-2">
            <img class="w-[20px] md:w-[30px] -ms-1" src="{{asset('site/coiny2.png')}}">
            <span class='text-xs md:text-base'>{{Auth::user()->ponygold}}</span>
        </div>
        <!--CRYSTAL HEART DISPLAY-->
        <div class="bg-white border border-amber-950 w-[90px] md:w-[120px] lg:w-[150px] rounded-2xl flex justify-between items-center pe-2 ">
            <img class="w-[20px] md:w-[30px] -ms-1"src="{{asset('site/crystalheart2.png')}}">
            <span class='text-xs md:text-base'>{{Auth::user()->crystalheart}}</span>
        </div>
    </div>
        <!--NOTIFICATIONS-->
        <img class="w-[30px] md:w-[55px] absolute top-[3px] right-0" src="{{asset('site/notification.png')}}" >
    @endif
<div>
</div>


<!-- Menu Bar & Latest Posts-->
<div class="absolute flex justify-between items-center top-0 left-0 lg:w-[400px] xl:w-[650px]">
    <img id="bottom-menu-btn" class=" hover:brightness-115 transition duration-300 w-[30px] sm:w-[35px]" src="{{asset('/site/menu.png')}}">
    <div class="bg-white w-4/5 rounded-2xl border border-amber-950 p-1">
        <p>Test stuff here</p>

    </div>
</div>

