@extends('layouts.app')

@section('page-title')
    {{$user[0]["name"]}}
@endsection

@section('page-content')
   <div class="wrapper flex flex-col  w-full   justify-start lg:flex-row">
        <div class=" ">
            <!--STABLE 1 ISLAND-->
            <div class="relative float">
                <img class="w-[320px] md:w-[520px]" src="{{asset('site/island1.png')}}">
                <img class="w-[180px] absolute top-[30px] left-[50px] md:w-[320px] md:top-[70px] md:left-[130px]" src="{{asset('site/house.png')}}">
            </div>
            <div class="flex justify-between items-center">
                    <img class="hover:brightness-130  w-[40px] h-[40px] -rotate-180 md:w-[80px] md:h-[80px]" src="{{asset('site/arrow.png')}}">
                    <div class=" goldbtn"><a href="/mystables/{{Auth::user()->id}}/1"><span>{{$user[0]["stable1"]}}</span></a></div>
                    <img class="w-[40px] h-[40px] hover:brightness-130  md:w-[80px] md:h-[80px]" src="{{asset('site/arrow.png')}}">
            </div>
            <!--STABLE 2 ISLAND-->
            <div>
            </div>
        </div>
        <!--Player Profile-->
        <div class="w-full lg:w-1/2 relative ">

                <a href="/nursery/{{Auth::user()->id}}"><button>Nursery</button></a>
            </div>
            
        </div><!--END OF PLAYER PROFILE-->
   </div>


@endsection