    <div class="w-full flex justify-evenly  mb-4 ">
        <div class="w-2/5 border relative">
            <h2 id="item_name4" class="bg-sky-100 text-lg font-bold 
            text-center rounded-2xl p-2 mb-2">Item Name</h2>
            <div class="p-4">
                <span class="font-bold">Description: </span><p class="inline p-2" id="item_desc4">--</p>
            </div>
            <div id="tags_4">

            </div>
            <ul class="w-full flex justify-evenly bg-sky-100 absolute bottom-2">
                <li class="hover:text-white" id="equip1">Equip</li>
                <li class="hover:text-white" id="use1">Use</li>                        
                <li class="hover:text-white" id="shop1">Add to Shop</li>
                <li class="hover:text-white" id="gallery1">Add to Gallery</li>
                <li class="hover:text-white" id="transfer1">Transfer</li>
            </ul>
        </div>
        <!--SINGLE ITEM IMAGE-->
        <div>
            <img id="single-img4" src="{{asset('site/blankitem.png')}}">
        </div>

</div>
    <div class="flex justify-center flex-wrap gap-4">
    @for($i=0; $i<count($group); $i++)
        @if(in_array($group[$i]["itemtype"],['Farm','Potion','Brush']))
            <div class="text-center relative {{$group[$i]["itemtype"]}}
            hover:bg-sky-200 hover:border-2
            hover:border-sky-400 rounded-4xl border-2
            border-sky-100 bg-sky-100 relative p-2" 
            onclick="changeDisplay4({{$group[$i]["itemid"]}})" 
            onmouseover="itemPopUp({{$group[$i]["itemid"]}})"
            onmouseout="closePopUp()">
                <h6 id="itemname{{$group[$i]["itemid"]}}">{{$group[$i]["itemname"]}}</h6>
                <img class="w-[120px] h-[120px]" src="/item/{{$group[$i]["itemid"]}}/icon">
                <h6 class="absolute bottom-[-25px] left-[35px] flex justify-center 
                    items-center bg-white h-[40px] w-[60px] rounded-t-full" id="qty{{$group[$i]["itemid"]}}">{{$qtylist[$i]}}</h6>
                <!--ITEM HOVER POPUP -->
                @include('user.components.hoveritem')
                <!--ITEM MENU -->
                <div class="text-left hidden h-full w-full rounded-4xl border-2 left-0
                        border-sky-300 bg-sky-300 absolute top-0 menuitem {{$group[$i]["itemid"]}}" id="{{$group[$i]["itemid"]}}">
                        <ul class="m-4">
                            <li class="hover:text-white">Equip</li>
                            <li class="hover:text-white">Use</li>                        
                            <li class="hover:text-white">Add to Shop</li>
                            <li class="hover:text-white">Add to Gallery</li>
                            <li class="hover:text-white">Transfer</li>
                        </ul>
                        <img class="hover:brightness-150 absolute right-[10px] bottom-[10px] w-[30px]" src="{{asset('site/redbutton.svg')}}">
                </div>
            </div>

        @endif

    
    @endfor
    </div>   