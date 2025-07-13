@extends('layouts.appopen')

@section('page-title')

@endsection

@section('page-content')

<div class="text-xl">
    <a href="/forums">Forum</a> > <a href="/forums/{{$category[0]["id"]}}/{{$category[0]["name"]}}/">{{$category[0]["name"]}}</a> ><span class="bubble text-5xl"> {{$topic[0]["subject"]}}</span>
</div>
<div class="mt-4 w-full lg:mx-auto lg:w-4/5">
    <div class="mx-auto w-full mb-2">
        {{$posts->links()}}        
    </div>

<table class="w-full ">
    @foreach($posts as $item)
        <tr class="border-t border-r bg-white">
            <td class="border w-[0px] lg:w-[320px]" rowspan="3">
                <img class="w-[120px] lg:w-[320px]" src="{{asset('site/winter-flora.png')}}">
            </td>
            <td class="border-b flex items-center justify-between">

                <div class="block w-[100px] h-[100px] overflow-hidden lg:hidden">
                    <img class="w-[320px]" src="{{asset('site/winter-flora.png')}}">
                </div>
                <a href="/profile/{{$item->post_by}}"><span>{{$item->post_user_name}}</span></a>

                @if($item->update_date)
                <span>Edited: {{$item->update_date}}</span>
                @else
                <span>{{$item->post_date}}</span>
                @endif
            </td>
        </tr>
        <tr class="border-r h-[300px] min-h-[300px] bg-white">
            <td class="p-2 post">
                {{$item->post_content}}</td>
        </tr>
        <tr class="border-r border-t border-b bg-gray-200">
            <td class="h-[90px] flex justify-between items-end">
                Footer
                <a href="/editpost/{{$item->id}}"><button id="editBtn">Edit</button></a>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="h-[12px]"></td>
        </tr>
    @endforeach
</table>
<div class="flex justify-end mb-2">
    <button id="newpost" >New Reply</button>
</div>
<div id="post-form" class="hidden relative w-full bg-white rounded-lg border p-2">
        <img class="hover:brightness-120 absolute right-[-10px] top-[-40px]" id="cancelpost" src="{{asset('site/closebutton.png')}}">

    <form method="POST" action="/newpost/{{$category[0]["id"]}}/{{$posts[0]["post_topic"]}}" >
        @csrf
        <label for="post-content">Reply</label>
        <textarea rows="15" class="w-full border border-sky-400 overflow-auto" name="post-content" id="post-content" required></textarea>
        <div class="flex justify-end">
            <button type="submit">Post</button>
        </div>
    </form>
</div>
</div>


    <script type="text/javascript" src="{{ asset('js/post.js') }}">
    </script>

@endsection