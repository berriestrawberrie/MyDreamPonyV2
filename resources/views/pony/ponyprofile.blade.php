<div class='w-full relative  bg-white md:w-3/4 md:shadow-lg md:rounded-4xl p-4 pt-[50px] md:mx-auto'>

            <div class='float absolute left-0 -top-[70px] md:-left-[70px] md:-top-[90px] '>
                <span class='page text-3xl md:text-5xl' id="page-title">
                    <!--THIS IS WHERE THE PAGES TITLE-->
                    {{$pony[0]["name"]}}
                </span>
                <img class=" w-[150px] md:w-[200px] -mt-8 md:-mt-10" src="{{asset('site/cloud.png')}}">
            </div>

            <div ><!--STUFF DIV-->
                <!--NEXT/PREVIOUS PONY ARROWS-->
                <div class="flex justify-between -mb-2">
                        <img  onclick="loadPartial('/previouspony/{{ $pony[0]["stable_assign"] }}/{{ $pony[0]["ponyid"] }}')" style="cursor: pointer;" class="hover:brightness-115 w-[30px]" src="{{ asset('site/caret-left2.png') }}">
                        <img onclick="loadPartial('/nextpony/{{ $pony[0]["stable_assign"] }}/{{ $pony[0]["ponyid"] }}')" style="cursor: pointer;" class="hover:brightness-115 w-[30px]"  src="{{ asset('site/caret2.png') }}">
                </div>

                <div class="flex flex-col xl:flex-row xl:justify-evenly mb-[50px]">
                    <div class=":w-[317px] h-[257px] md:w-[599px] md:h-[485px] flex items-center justify-center overflow-hidden">
                        @if($pony[0]["age"] >= 14)
                            @if($pony[0]["modified"] > 0)
                                <img class="max-w-full max-h-full object-contain" src="{{ asset('ponys/mod/'.$pony[0]["image"]) }}?{{ uniqid() }}">
                            @else
                                <img class="max-w-full max-h-full object-contain" src="{{ asset('ponys/adult/'.$pony[0]["image"]) }}?{{ uniqid() }}">
                            @endif
                        @else
                            <img class="max-w-full max-h-full object-contain" src="{{ asset('ponys/baby/'.$pony[0]["image"]) }}?{{ uniqid() }}">
                        @endif
                    </div>

                    @include('pony.components.ponystats')
                </div>

                @include('pony.components.ponytabs')

            </div><!--END OF STUFF DIV-->
        </div><!--END OF PAGE DIV-->






