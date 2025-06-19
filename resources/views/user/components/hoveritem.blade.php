<div class="popup{{$group[$i]["itemid"]}} rounded-2xl hidden bg-white border w-[200px] p-2
            absolute top-[-150px]  z-10">
    <span class="mb-2" id="itemtype{{$group[$i]["itemid"]}}">{{$group[$i]["itemtype"]}}</span>
    <p id="itemdesc{{$group[$i]["itemid"]}}"><b>Description:</b>{{$group[$i]["info"]}}</p>
    <div id="tags{{$group[$i]["itemid"]}}">
        @foreach($tags[$i] as $tag)
        <span class="bg-sky-200 rounded-lg p-1 inline-flex">{{$tag}}</span>   
        @endforeach
    </div>
</div>