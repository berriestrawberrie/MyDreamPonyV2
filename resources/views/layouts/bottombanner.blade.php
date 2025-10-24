<div class="border-t-1 border-b-2 border-b-amber-300 border-t-amber-950 bg-amber-400 
            w-full h-[43px] fixed bottom-0 z-1">
    <!--SHINE-->
    <img class="absolute top-0 left-0 " src="{{asset('site/shine.svg')}}">
    @if(Auth::user())
<ul id="bottom-nav-icons" class="absolute left-0  sm:left-[20%] -mt-2 md:w-3/5 md:-mt-10 whitespace-nowrap text-center pt-4 transition-transform duration-500 ease-in-out translate-y-0">        
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[40px] sm:w-[60px]">
                <a href="/ponygen/selectbreed"><img src="{{asset('site/crystalheart.png')}}"></a>
            </li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[40px] sm:w-[60px]">
                <a href="/mystables/{{Auth::user()->id}}/1"><img src="{{asset('site/shoe.png')}}"></a></li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[40px] sm:w-[60px]">
                <a href="/inventory/{{Auth::user()->id}}"><img src="{{asset('site/chest.png')}}"></a></li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[40px] sm:w-[60px]"><img src="{{asset('site/map2.png')}}"></li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[40px] sm:w-[60px]"><a href="/contests"><img src="{{asset('site/trophy.png')}}"></a></li>
            <li class="hover:-translate-y-[20px] inline-flex transition duration-300 w-[40px] sm:w-[60px]"><a href="/forums"><img src="{{asset('site/forum.png')}}"></a></li>
        </ul>
    @endif
    <img id="bottom-menu-btn" class="absolute right-[8px] bottom-[8px] sm:right-[5px] sm:bottom-[0px]  hover:brightness-115 transition duration-300 w-[30px] sm:w-[40px]" src="{{asset('/site/menu.png')}}"></li>
</div>

<script>
    const menuBtn = document.getElementById('bottom-menu-btn');
    const navIcons = document.getElementById('bottom-nav-icons');

    menuBtn.addEventListener('click', () => {
        const isVisible = navIcons.classList.contains('translate-y-0');

        if (isVisible) {
            navIcons.classList.remove('translate-y-0');
            navIcons.classList.add('-translate-y-19','sm:-translate-y-22');
        } else {
            navIcons.classList.remove('-translate-y-19','sm:-translate-y-22');
            navIcons.classList.add('translate-y-0');
        }
    });
</script>