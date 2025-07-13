@extends('layouts.appopen')

@section('page-title')
{{$name}}
@endsection

@section('page-content')

<div class="text-2xl">
    <a href="/forums">Forum</a> > {{$name}}
</div>
<div class=" mx-auto w-3/5 flex justify-end">
    <button id="opentopic">New Topic</button>
</div>
@include('forum.component.newtopic')

<div class="mt-4">
    <div class="mx-auto w-3/5">
        {{$topics->links()}}        
    </div>
    <table class="mx-auto w-3/5 table-auto text-center">
        <tr>
            <th class="text-left">Topic Title</td>
            <th class="w-[60px]">Replies</td>
            <th class="w-[120px]">Updated</td>
            <th class="w-[120px] ">Posted</th>
        </tr>
        @foreach($topics as $item)
        <tr class="bg-white/60 border-b-2 border-sky-300 hover:bg-white h-[40px]">
            <td class="text-left ps-2">
               <a href="/post/{{$item->category}}/{{$item->id}}"> {{$item->subject}} </a>
            </td>
            <td class=" border-l-1 border-r-1 border-sky-300">{{$item->post_count}}</td>
            <td class=" border-l-1 border-r-1 border-sky-300">--</td>
            <td class=" border-l-1 border-r-1 border-sky-300">
                {{$item->date}}
                <a href="/profile/{{$item->topic_by}}"><p>{{$item->user_name}}#{{$item->topic_by}}</p></a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

    <script type="text/javascript" src="{{ asset('js/topic.js') }}">
    </script>

@endsection