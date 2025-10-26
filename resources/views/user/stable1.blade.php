<div class='w-full relative  p-4 pt-[50px] '>
    <div class='float absolute left-0 -top-[70px]  md:-top-[90px] '>
        <span class='page text-3xl md:text-5xl'>{{$user[0]["stable1"]}}</span>
        <img class=" w-[150px] md:w-[200px] -mt-8 md:-mt-10" src="{{asset('site/cloud.png')}}">
    </div>
    
       <ul class="sortable list-none flex flex-wrap justify-center gap-2 h-[800px] overflow-visible">
        @foreach($ponys as $pony)
            <li class="rounded-2xl" data-index="{{$pony->ponyid}}" data-position="{{$pony->stable_ord}}">
                @include('pony.components.ponypedal')
            </li>
        @endforeach

    </ul>

    </div>





    <script type="text/javascript" src="{{ asset('js/stables.js') }}">
    </script>

