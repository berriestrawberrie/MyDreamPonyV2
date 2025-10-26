

<div class="w-full flex justify-evenly  mb-4 ">
        <div class="w-full sm:w-2/5 border relative">
            <div id="item-stuff1">
                <h2 id="item_name1" class="bg-sky-100 text-lg font-bold 
                text-center rounded-2xl p-2 mb-2">Item Name</h2>
                <div class="p-4">
                    <span class="font-bold">Description: </span><p class="inline p-2" id="item_desc1">--</p>
                </div>
                <div id="tags_1">

                </div>
                <ul class="w-full flex justify-evenly">
                    <li class="hover:text-white"><button onclick="actionPet('feedPet','item-stuff1','cancelitem1')" id="equip1" class="hidden">Feed</button></li>                  
                    <li class="hover:text-white  bg-sky-100 p-2" id="shop1">Add to Shop</li>
                    <li class="hover:text-white  bg-sky-100 p-2" id="gallery1">Add to Gallery</li>
                    <li class="hover:text-white  bg-sky-100 p-2" id="transfer1">Transfer</li>
                </ul>
            </div>
            @if(count($ponys)>0)
            <div id="feedPet" class="hidden mb-[50px]">
                    <div class="flex">
                        <form action="/feedpet" method="POST">
                            @csrf
                            @method('POST')
                        <input number id="foodfed" name="foodfed" class="hidden">
                        <select id="feedPetSelect" name="ponyfed" onchange="actionWhichPet('feedPet')">
                        @foreach($ponys as $pony)
                        <option value="{{$pony->ponyid}},{{$pony->age}}">{{$pony->name}}</option>
                        @endforeach
                        </select>
                        <button type="submit">Confirm</button>
                        </form>
                        <button id="cancelitem1">Cancel</button>
                    </div>
                     @if($pony->age > 14)
                     <img id="feedPetImg" class="w-[320px] md:w-[359px]" src="{{asset('ponys/adult/'.$pony->image)}}?{{uniqid()}}">
                     @else
                     <img id="feedPetImg" class="w-[320px] md:w-[359px]" src="{{asset('ponys/baby/'.$pony->image)}}?{{uniqid()}}">
                     @endif
            </div>
            @endif
        </div>
        <!--SINGLE ITEM IMAGE-->
        <div>
            <img class="hidden sm:block" id="single-img1" src="{{asset('site/blankitem.png')}}">
        </div>

</div>
<div class="flex justify-center flex-wrap gap-4">

    @if(count($group)>0)
        @for($i=0; $i<count($group); $i++)
            @if($group[$i]["itemtype"] === "Food")
                <div class="w-[90px] md:w-[150px] text-center relative {{$group[$i]["itemtype"]}}
                hover:bg-sky-200 hover:border-2
                hover:border-sky-400 rounded-4xl border-2
                border-sky-100 bg-sky-100 relative p-1" 
                onclick="changeDisplay1({{$group[$i]["itemid"]}})" 
                onmouseover="itemPopUp({{$group[$i]["itemid"]}})"
                onmouseout="closePopUp()">
                    <h6 class="text-xs md:text-base text-wrap" id="itemname{{$group[$i]["itemid"]}}">{{$group[$i]["itemname"]}}</h6>
                    <img class="w-[60px] h-[60px] md:w-[120px] md:h-[120px] mx-auto" src="/item/{{$group[$i]["itemid"]}}/icon">
                    <h6 class="absolute bottom-[-30px] left-[15px] flex justify-center  md:left-[40px]
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
    @else
    --
    @endif
</div>   