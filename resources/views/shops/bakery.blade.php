
<div class='w-full relative  bg-white md:w-3/4 md:shadow-lg md:rounded-4xl p-4 pt-[50px] md:mx-auto md:max-w-[900px] mb-10'>

            <div class='float absolute left-0 -top-[70px] md:-left-[70px] md:-top-[90px] '>
                <span class='page text-3xl md:text-5xl' id="page-title">
                    <!--THIS IS WHERE THE PAGES TITLE-->
                    Whisker & Whisk
                </span>
                <img class=" w-[150px] md:w-[200px] -mt-8 md:-mt-10" src="{{asset('site/cloud.png')}}">
            </div>

            <div class="relative flex justify-center items-start gap-2 flex-wrap h-full "><!--STUFF DIV-->
              
                @foreach($items as $item)
                    <div id="{{$item->itemid}}" onclick="changeDialog({{$item->itemid}})" class="border w-[95px] h-[170px] sm:w-[110px] sm:h-[200px] border-sky-400 rounded p-1 flex flex-col items-center"
                    data-rarity="{{ $item->rarity }}"
                    data-info="{{ $item->info }}"
                    data-tags="{{ $item->tags }}"
                    data-itemname="{{$item->itemname}}"
                    data-itemtype="{{ $item->itemtype }}"
                    data-buff="{{ $item->buff}}"
                    data-debuff="{{ $item->debuff}}"
                    data-user="{{Auth::user()->id}}"
                    data-price="{{$item->price}}"
                    >
                        @switch($item->rarity)
                            @case('common')
                                <span class="text-xs font-bold text-gray-400 border border-gray-400 px-2 py-1 bg-gray-100 rounded-2xl">Common</span>
                                @break

                            @case('uncommon')
                                <span class="text-xs font-bold text-green-600 border border-green-600 px-2 py-1 bg-green-100 rounded-2xl">Uncommon</span>
                                @break

                            @case('rare')
                                <span class="text-xs font-bold text-blue-500 border border-blue-500 px-2 py-1 bg-blue-100 rounded-2xl">Rare</span>
                                @break

                            @case('crystal')
                                <span class="text-xs font-bold text-cyan-500 border border-cyan-500 px-2 py-1 bg-cyan-100 rounded-2xl">Crystal</span>
                                @break

                            @case('seasonal')
                                <span class="text-xs font-bold text-orange-500 border border-orange-500 px-2 py-1 bg-orange-100 rounded-2xl">Seasonal</span>
                                @break

                            @case('legendary')
                                <span class="text-xs font-bold text-purple-700 border border-purple-700 px-2 py-1 bg-purple-100 rounded-2xl">Legendary</span>
                                @break

                            @case('mythic')
                                <span class="text-xs font-bold text-yellow-400 border border-yellow-400 px-2 py-1 bg-yellow-100 rounded-2xl">Mythic</span>
                                @break

                            @default
                                <span class="text-xs font-bold text-neutral-500 border border-neutral-500 px-2 py-1 bg-neutral-100 rounded-2xl">Unknown Rarity</span>
                        @endswitch
                        <img onclick="changeDialog({{$item->itemid}})" title="{{$item->info}}" class="w-[65px] h-[65px] sm:w-[90px] sm:h-[90px]" src="{{ asset('items/food/' . $item->itemid . '.png') }}">
                        <b onclick="changeDialog({{$item->itemid}})" class="text-sm -mt-2 text-center">{{$item->itemname}}</b>
                        <p class="text-xs" >{{$item->stock}} in stock</p>
                        
                        <div class="flex items-center">
                            <img  class="w-[20px]" src="{{asset('site/coiny2.png')}}">
                            <p class="text-sm">{{$item->price}}</p>
                            
                        </div>
                    </div>
                
                @endforeach

                

            </div><!--END OF STUFF DIV-->
        <!--NPC DIALOG-->
        <div  class="fixed  border-3 -ms-4  w-full border-amber-600 rounded-se-lg bg-amber-50  bottom-[44px] md:w-3/4 md:max-w-[900px] h-[180px]">
            <img class=" hidden sm:block absolute  w-[250px]   lg:w-[300px] sm:bottom-0  sm:right-0 md:-bottom-[90px]" src="{{asset('npcs/Meowella.png')}}">
            <img class=" hidden absolute -top-[182px]  w-[180px] " src="{{asset('npcs/meowella-av.png')}}">
                <div class="absolute -top-[33px] p-1 text-center -left-[2px] bg-amber-600 w-[160px] rounded-t-lg rounded-b-none font-bold tracking-wider">Meowella</div>
                <!--NPC INTERACTIONS-->
                       <div class="flex absolute items-center -top-[35px] gap-2 left-[200px] sm:left-[170px]">
                            <span title="Chit Chat"><i class="fa-solid text-3xl text-amber-600  fa-comment"></i></span>
                            <span title="Give Gift"><i class="fa-solid text-3xl text-amber-600   fa-gift"></i></span>
                            <span title="Social Status"><i class="fa-solid text-3xl text-amber-600   fa-circle-question"></i></span>
                       </div>
                <!--END OF NPC INTERACTIONS-->
                <div  class=" sm:max-w-3/5 p-1 overflow-visible h-full">

                    <!--NPC STUFF HERE-->
                    <div id="npc-talk">
                        Welcome to the Whisker & Whisk
                    </div>
                    <b class="block sm:hidden text-sm text-left" id="title2">Choco Donut</b>
                    <div id="dialog" class="hidden items-start gap-2">
                        <div class="min-w-[70px] max-w-[70px] h-[100px] sm:min-w-[120px] sm:max-w-[120px] sm:h-[150px] flex flex-col items-center justify-start overflow-hidden text-center ">
                            <b class="hidden sm:block text-sm text-center" id="title">Choco Donut</b>
                            <img id="image" class="w-[65px] h-[65px] sm:w-[90px] sm:h-[90px]" src="{{asset('items/food/12.png')}}">
                            
                        </div>
                        <div class="sm:h-[150px] sm:w-[500px]">
                            <p id="info" class="text-sm sm:text-base">Choco description here</p>
                            <span id="tags" class="text-sm sm:text-base"><b>Tags: </b>Tags here</span>
                            <div class="w-full flex gap-2 justify-end -mt-2 sm:mt-0">
                                <span class="relative border-4 border-amber-400 bg-red-400 p-2 hover:bg-red-500 rounded-2xl" onclick="cancelSale() ">Cancel
                                    <img class="absolute w-[10px] top-[3px] right-[3px] opacity-80 " src="{{asset('site/white-shine.png')}}">
                                </span>                                
                                <form id="itemForm" action="/" method="POST">
                                    @csrf
                                    @method('POST')
                                <button type="submit" class="relative border-4 border-amber-400 bg-sky-400 p-2 hover:bg-sky-500 rounded-2xl">Buy
                                    <img class="absolute w-[10px] top-[3px] right-[3px] opacity-80 " src="{{asset('site/white-shine.png')}}">
                                </button>
                                </form>
                        </div>

                        </div>
                    </div>

                    

                </div><!--END OF DIALOG-->

                </div>
        </div><!--END OF PAGE DIV-->

    <script src="{{ asset('js/npcshop.js') }}"></script>
