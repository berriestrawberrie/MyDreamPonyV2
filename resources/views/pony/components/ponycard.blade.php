<!--OLD CARD-->

    <div class="bg-white border rounded-lg">
    <!--PONY STATUSES TOP-->
    <div class="relative bg-amber-500 rounded-t-lg h-[30px]">
            <img class="absolute top-0 right-0 h-[30px]" src="{{asset('site/shine.svg')}}">
            <a href="/ponyprofile/{{$pony->ponyid}}"><h3 class="absolute top-0 left-[60px] text-center">{{$pony->name}}</h3></a>
            <!--HEALTH STATUS-->
            @if($pony->health<100)<img class="absolute -right-[5px] -top-[8px] w-[25px]" src="{{asset('site/statu-heart.svg')}}">@endif

    </div>
    @if($pony->age >=14)
        <a href="/ponyprofile/{{$pony->ponyid}}"><img class=" border-l-4 border-r-4 border-amber-500 w-[120px] md:w-[200px] lg:w-[250px]" src="{{asset('ponys/adult/'.$pony->image)}}?{{uniqid()}}" loading="lazy" alt="pony image" width="300" height="300"></a>
    @else
        <a href="/ponyprofile/{{$pony->ponyid}}"><img class=" border-l-4 border-r-4 border-amber-500 w-[120px] md:w-[200px] lg:w-[250px]" src="{{asset('ponys/baby/'.$pony->image)}}?{{uniqid()}}" loading="lazy" alt="pony image" width="300" height="300"></a>
    @endif

    <!--PONY STATUSES BOTTOM-->
    <div class="bg-amber-500 rounded-b-lg h-[20px]">
    </div>
</div>