<div class="border-t-1 border-b-2 border-b-amber-300 border-t-amber-950 bg-amber-400 
            w-full h-[43px] fixed bottom-0 z-10">
    <!--SHINE-->
    <img class="absolute top-0 left-0 " src="{{asset('site/shine.svg')}}">
    @if(Auth::user())
<ul id="bottom-nav-icons" class="absolute left-0  sm:left-[20%] -mt-2 md:w-3/5 md:-mt-10 whitespace-nowrap text-center pt-4 transition-transform duration-500 ease-in-out translate-y-0">        
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[40px] sm:w-[60px]">
                    <img onclick="loadPartial('/ponygen/selectbreed')" style="cursor: pointer;" src="{{ asset('site/crystalheart.png') }}">
            </li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[40px] sm:w-[60px]">
                <img  onclick="loadPartial('/mystables/{{Auth::user()->id}}/1')" style="cursor: pointer;" src="{{asset('site/shoe.png')}}"></li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[40px] sm:w-[60px]">
                <a href="/inventory/{{Auth::user()->id}}"><img src="{{asset('site/chest.png')}}"></a></li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[40px] sm:w-[60px]"><img onclick="loadPartial('/explore')" src="{{asset('site/map2.png')}}"></li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[40px] sm:w-[60px]"><a href="/contests"><img src="{{asset('site/trophy.png')}}"></a></li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[40px] sm:w-[60px]"><a href="/forums"><img src="{{asset('site/forum.png')}}"></a></li>
        </ul>
    @endif
</div>

