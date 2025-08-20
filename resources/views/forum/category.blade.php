@extends('layouts.appopen')

@section('page-title')
Forums
@endsection

@section('page-content')

<div class="w-full lg:mx-auto lg:w-4/5">
    <!--CATEGORIES-->
        <div>
            <h3 class="bubble text-3xl" id="news">News & Announcements</h3>
            <table class=" w-full text-center table-auto mt-4">
                @foreach($newsCat as $item)
                    <tr class="bg-white/60 border-b-4 border-sky-300 hover:bg-white">
                        <td class="">
                            <a href="../forums/{{$item->id}}/{{$item->name}}"><img class="mx-auto max-w-[40px] lg:max-w-[90px]" src="{{asset('forum/'.$item->icon)}}" loading="lazy" alt="{{$item->name}}" width="90" height="90"></a>
                        </td>
                        <td class="text-left ps-1">
                           <a href="../forums/{{$item->id}}/{{$item->name}}"><span class="text-sm font-bold lg:text-xl">{{$item->name}} </span></a>
                            <p class="text-xs lg:text-base">{{$item->desc}}</p>
                        </td>
                        <td>
                            <span class="text-xs">999,999 Topics</span>
                        </td>
                        <td class="">
                            <span class="text-xs">999,999 Topics</span>
                        </td>
                        <td class="hidden lg:block text-right"><span>Lastest Post</span>
                            <p>Welcome to blah blah..</p>
                        </td>
                    </tr>
                @endforeach
            </table>
            <h3 class="bubble text-3xl" id="chat">Chats & Introductions</h3>
            <table class=" w-full text-center table-auto mt-4">
                @foreach($chatCat as $item)
                    <tr class="bg-white/60 border-b-4 border-sky-300 hover:bg-white">
                        <td class="">
                            <a href="../forums/{{$item->id}}/{{$item->name}}"><img class="mx-auto max-w-[40px] lg:max-w-[90px]" src="{{asset('forum/'.$item->icon)}}" loading="lazy" alt="{{$item->name}}" width="90" height="90"></a>
                        </td>
                        <td class="text-left ps-1">
                            <a href="../forums/{{$item->id}}/{{$item->name}}"><span class="text-sm font-bold lg:text-xl">{{$item->name}} </span></a>
                            <p class="text-xs lg:text-base">{{$item->desc}}</p>
                        </td>
                        <td>
                            <span class="text-xs">999,999 Topics</span>
                        </td>
                        <td class="">
                            <span class="text-xs">999,999 Topics</span>
                        </td>
                        <td class="hidden lg:block text-right"><span>Lastest Post</span>
                            <p>Welcome to blah blah..</p>
                        </td>
                    </tr>
                @endforeach
            </table>
            <h3 class="bubble text-3xl" id="pony">World Building</h3>
            <table class=" w-full text-center table-auto mt-4">
                @foreach($worldCat as $item)
                    <tr class="bg-white/60 border-b-4 border-sky-300 hover:bg-white">
                        <td class="">
                            <img class="mx-auto max-w-[40px] lg:max-w-[90px]" src="{{asset('forum/'.$item->icon)}}" loading="lazy" alt="{{$item->name}}" width="90" height="90">
                        </td>
                        <td class="text-left ps-1">
                            <span class="text-sm font-bold lg:text-xl">{{$item->name}} </span>
                            <p class="text-xs lg:text-base">{{$item->desc}}</p>
                        </td>
                        <td>
                            <span class="text-xs">999,999 Topics</span>
                        </td>
                        <td class="">
                            <span class="text-xs">999,999 Topics</span>
                        </td>
                        <td class="hidden lg:block text-right"><span>Lastest Post</span>
                            <p>Welcome to blah blah..</p>
                        </td>
                    </tr>
                @endforeach
            </table>
            <h3 class="bubble text-3xl" id="game">Game Mechanics</h3>
            <table class=" w-full text-center table-auto mt-4">
                @foreach($gameCat as $item)
                    <tr class="bg-white/60 border-b-4 border-sky-300 hover:bg-white">
                        <td class="">
                            <a href="../forums/{{$item->id}}/{{$item->name}}"><img class="mx-auto max-w-[40px] lg:max-w-[90px]" src="{{asset('forum/'.$item->icon)}}" loading="lazy" alt="{{$item->name}}" width="90" height="90"></a>
                        </td>
                        <td class="text-left ps-1">
                            <a href="../forums/{{$item->id}}/{{$item->name}}"><span class="text-sm font-bold lg:text-xl">{{$item->name}} </span></a>
                            <p class="text-xs lg:text-base">{{$item->desc}}</p>
                        </td>
                        <td>
                            <span class="text-xs">999,999 Topics</span>
                        </td>
                        <td class="">
                            <span class="text-xs">999,999 Topics</span>
                        </td>
                        <td class="hidden lg:block text-right"><span>Lastest Post</span>
                            <p>Welcome to blah blah..</p>
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
</div>

            

@endsection
