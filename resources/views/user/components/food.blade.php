<div class="w-full flex justify-evenly  mb-4 ">
        <div class="w-2/5 border relative">
            <h2 id="item_name1" class="bg-sky-100 text-lg font-bold 
            text-center rounded-2xl p-2 mb-2">Item Name</h2>
            <div class="p-4">
                <span class="font-bold">Description: </span><p class="inline p-2" id="item_desc1">--</p>
            </div>
            <div id="tags_1">

            </div>
            <ul class="w-full flex justify-evenly absolute bottom-2">
                <li class="hover:text-white"><button onclick="actionPet('feedPet','equip1','Feed')" id="equip1">Feed</button></li>                  
                <li class="hover:text-white  bg-sky-100 p-2" id="shop1">Add to Shop</li>
                <li class="hover:text-white  bg-sky-100 p-2" id="gallery1">Add to Gallery</li>
                <li class="hover:text-white  bg-sky-100 p-2" id="transfer1">Transfer</li>
            </ul>
            <div id="feedPet" class="hidden mb-[50px]">
                    <div class="flex">
                        <form action="/feedpet" method="POST">
                            @csrf
                            @method('POST')
                        <input number id="foodfed" name="foodfed" class="hidden">
                        <select id="feedPetSelect" name="ponyfed" onchange="actionWhichPet('feedPet')">
                        @foreach($ponys as $pony)
                        <option value="{{$pony->ponyid}}">{{$pony->name}}</option>
                        @endforeach
                        </select>
                        <button type="submit">Confirm</button>
                        </form>
                    </div>
                     <img id="feedPetImg" class="w-[359px] h-[291px]" src="/pony/image/{{$ponys[0]["ponyid"]}}">
            </div>
        </div>
        <!--SINGLE ITEM IMAGE-->
        <div>
            <img id="single-img1" src="{{asset('site/blankitem.png')}}">
        </div>

</div>
<div class="flex justify-center flex-wrap gap-4">
    @for($i=0; $i<count($group); $i++)
        @if($group[$i]["itemtype"] === "Food")
            <div class="text-center relative {{$group[$i]["itemtype"]}}
            hover:bg-sky-200 hover:border-2
            hover:border-sky-400 rounded-4xl border-2
            border-sky-100 bg-sky-100 relative p-2" 
            onclick="changeDisplay1({{$group[$i]["itemid"]}})" 
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