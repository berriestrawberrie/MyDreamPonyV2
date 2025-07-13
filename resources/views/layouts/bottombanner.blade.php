<div class="border-t-1 border-b-2 border-b-amber-300 border-t-amber-950 bg-amber-400 
            w-full h-[43px] fixed bottom-0 z-1">
    <!--SHINE-->
    <img class="absolute top-0 left-0 " src="{{asset('site/shine.svg')}}">

    @if(Auth::user())
        <ul class='absolute w-full left-0 bottom-[10px] sm:left-[20%] -mt-2 md:w-3/5 md:-mt-10  whitespace-nowrap overflow-x-auto text-center pt-4' >
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[50px] sm:w-[90px]">
                <a href="/ponygen/selectbreed"><img src="{{asset('site/crystalheart.png')}}"></a>
            </li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[50px] sm:w-[90px]">
                <a href="/mystables/{{Auth::user()->id}}/1"><img src="{{asset('site/shoe.png')}}"></a></li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[50px] sm:w-[90px]">
                <a href="/inventory/{{Auth::user()->id}}"><img src="{{asset('site/chest.png')}}"></a></li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[50px] sm:w-[90px]"><img src="{{asset('site/map2.png')}}"></li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[50px] sm:w-[90px]"><a href="/contests"><img src="{{asset('site/trophy.png')}}"></a></li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[50px] sm:w-[90px]"><a href="/forums"><img src="{{asset('site/forum.png')}}"></a></li>
     
        </ul>
    @endif

</div>