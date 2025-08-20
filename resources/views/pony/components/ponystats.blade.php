<div class="min-w-[200px] text-center border-2 rounded-2xl border-sky-300">
    <!--HEALTH & HUNGER-->
    <div class="border-b-2 border-sky-300 flex flex-col md:flex-row justify-evenly xl:flex-col items-center mb-2">
        <div >
            <h5>HP: {{$pony[0]["health"]}} /100</h5>
            <div class="relative">
                <img class="w-[200px]" src="{{asset('site/emptyhp.svg')}}">
                <div class="border border-red-800 bg-gradient-to-b from-red-400 via-red-600 to-red-700 absolute rounded-md top-[10px] left-[40px]  h-[18px]" style="max-width:142px; width: {{$pony[0]["health"]}}%;"></div>
            </div>
        </div>
        <div>
            <h5>Hunger: {{$pony[0]["hunger"]}} /100</h5>
            <div class="relative">
                <img class="w-[200px]" src="{{asset('site/emptyhunger.svg')}}">
                <div class="border border-lime-800 bg-gradient-to-b from-lime-400 via-lime-600 to-lime-700 absolute rounded-md top-[10px] left-[40px]  h-[18px]" style="max-width:142px; width: {{$pony[0]["hunger"]}}%;"></div>
            </div>
        </div>
    </div>
    <!--PONY COLORS-->
    <div class="border-b-2 border-sky-300 ">
        <table class=" w-full h-[120px]">
            <tr class="">
                <td class="h-[20px]"><b>Eye:</b></td>
                <td class="flex justify-start gap-2 uppercase items-center">
                    <div class="w-[20px] border rounded h-[20px]"style="background-color:#{{$pony[0]["eyeCol"]}}">
                    </div>
                    #{{$pony[0]["eyeCol"]}}
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="h-[20px]"><b>Coat:</b></td>
                <td class="flex justify-start gap-2 uppercase items-center">
                    <div class="w-[20px] border rounded h-[20px]"style="background-color:#{{$pony[0]["baseCol"]}}">
                    </div>
                    #{{$pony[0]["baseCol"]}}
                </td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="h-[20px]"><b>Hair:</b></td>
                <td class="flex justify-start gap-2 uppercase items-center pe-2">
                    <div class="w-[20px] border rounded h-[20px]"style="background-color:#{{$pony[0]["hairCol"]}}">
                    </div>
                    #{{$pony[0]["hairCol"]}}
                </td>
                <td></td>
                <td class="flex justify-start gap-2 uppercase items-center">
                    <div class="w-[20px] border rounded h-[20px]"style="background-color:#{{$pony[0]["hairCol2"]}}">
                    </div>
                    #{{$pony[0]["hairCol2"]}}
                </td>
            </tr>
            <tr>
                <td class="h-[20px]"><b>Accent:</b></td>
                <td class="flex justify-start gap-2 uppercase items-center pe-2">
                    <div class="w-[20px] border rounded h-[20px]"style="background-color:#{{$pony[0]["accentCol"]}}">
                    </div>
                    #{{$pony[0]["accentCol"]}}
                </td>
                <td></td>
                <td class="flex justify-start gap-2 uppercase items-center">
                    <div class="w-[20px] border rounded h-[20px]"style="background-color:#{{$pony[0]["accentCol2"]}}">
                    </div>
                    #{{$pony[0]["accentCol2"]}}
                </td>
            </tr>

        </table>
    </div>
    <!--EXP-->
    <div class="flex justify-evenly border-b-2 border-sky-300 ">
        <!--LEVEL-->
        <div class="flex flex-col items-center ">
            <h4>Level</h4>
            <p>{{$pony[0]["level"]}}</p>
        </div>
        <!--EXP BAR-->
        <div>
        <h5 class="text-center">EXP: {{$pony[0]["exp"]}} /100</h5>
        <div class="relative">
            <img class="w-[180px]" src="{{asset('site/emptyexp.svg')}}">
            <div class="border border-amber-800 bg-gradient-to-b from-amber-400 via-amber-500 to-amber-600 absolute rounded-md top-[9px] left-[30px]  h-[18px]" style="max-width:134px; width: {{$pony[0]["exp"]}}%;"></div>
        </div>
        </div>
    </div>
    <!--STATS-->
    <table class="w-full  text-center border-b-2 border-sky-300 ">
        <tr>
            <td>Intelligence</td>
            <td>Charm</td>
            <td>Strength</td>            
        </tr>
        <tr>
            <td>{{$pony[0]["intel"]}}</td>
            <td>{{$pony[0]["charm"]}}</td>
            <td>{{$pony[0]["str"]}}</td>        
        </tr>
    </table>
    <button class="mb-2">Quests?</button>
    <form method="POST" action="/ageUp" enctype="multipart/form-data">
        @csrf
        <input class="hidden" type="number" value="{{$pony[0]["ponyid"]}}" name="ponyid">
        <button type="submit">Age Up</button>
    </form>

</div>