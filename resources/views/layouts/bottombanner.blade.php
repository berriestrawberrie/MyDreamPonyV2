<div class="border-t-1 border-b-2 border-b-amber-300 border-t-amber-950 bg-amber-400 
            w-full h-[43px] fixed bottom-0 z-1">
    <!--SHINE-->
    <img class="absolute top-0 left-0 " src="{{asset('site/shine.svg')}}">

    @if(Auth::user())
        <ul class='mx-auto flex justify-evenly w-1/2 -mt-2 md:w-1/4 md:-mt-10' >
        <li class="hover:-translate-y-[20px] transition duration-300 w-[50px] md:w-[80px]">
            <a href="/ponygen/selectbreed"><img src="{{asset('site/crystalheart.png')}}"></a>
        </li>
        <li class="hover:-translate-y-[20px] transition duration-300 w-[50px] md:w-[80px]"><img src="{{asset('site/shoe.png')}}"></li>
        <li class="hover:-translate-y-[20px] transition duration-300 w-[50px] md:w-[80px]"><img src="{{asset('site/chest.png')}}"></li>
        <li class="hover:-translate-y-[20px] transition duration-300 w-[50px] md:w-[80px]"><img src="{{asset('site/map2.png')}}"></li>
    </ul>
    @endif

</div>