<div class="relative">
    <!--PONY STATUSES TOP-->
    <div class="">
       <a href="/ponyprofile/{{$pony->ponyid}}"> <h3 class="page text-lg md:text-2xl lg:text-3xl">{{$pony->name}}</h3></a>
    </div>
    <img class="w-[120px] md:w-[200px] lg:w-[300px]" src="{{asset('site/blank.png')}}">
    <img  class="absolute top-0 w-[120px] md:w-[200px] lg:w-[300px]" src="{{asset('site/cloudpedal.png')}}">
    @if($pony->age >=14)
        <a href="/ponyprofile/{{$pony->ponyid}}"><img class=" absolute top-0 w-[120px] md:w-[200px] lg:w-[300px]" src="{{asset('ponys/adult/'.$pony->image)}}?{{uniqid()}}" loading="lazy" alt="pony image" width="300" height="300"></a>
    @else
        <a href="/ponyprofile/{{$pony->ponyid}}"><img class=" absolute top-0 w-[120px] md:w-[200px] lg:w-[300px]" src="{{asset('ponys/baby/'.$pony->image)}}?{{uniqid()}}" loading="lazy" alt="pony image" width="300" height="300"></a>
    @endif
    <!--PONY STATUSES BOTTOM-->
    <div class="">
    </div>
</div>
