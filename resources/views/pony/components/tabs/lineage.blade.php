<div>
    <div class="flex justify-around items-center">
        <div class="relative p-2  w-1/2">
            <div>
                <h4 class="text-xs sm:text-lg font-bold" >Fillies:{{count($filly)}}</h4>
            </div>
            <ul class="p-1 border border-sky-400 rounded-lg flex flex-wrap justify-center items-center h-24 overflow-auto">
                @if($filly)
                @for($i=0 ; $i< count($filly); $i++)
                <li>
                    @php
                    $found1 = collect($babies)->firstWhere('token', $filly[$i]);
                    @endphp
                        <img onclick="loadPartial('/ponyprofile/{{ $found1->ponyid }}')" style="cursor: pointer;" title="{{ $found1->name }}" class="mx-auto w-[100px]" src="{{asset('ponys/baby/'. $found1->ponyid.'.png')}}">
                </li>
                @endfor
                @else
                <li>None</li>
                @endif

            </ul>
        </div>
        <div class="relative  p-2 ms-1 w-1/2">
            <div>
                <h4 class="text-xs sm:text-lg font-bold" >Colts: {{count($colt)}}</h4>
            </div>
            <ul class="flex  border border-sky-400 rounded-lg flex-wrap  justify-center items-center h-24 overflow-auto">
                @if($colt)
                @for($i=0 ; $i< count($colt); $i++)
                <li>
                    @php
                    $found2 = collect($babies)->firstWhere('token', $colt[$i]);
                    @endphp

                        <img onclick="loadPartial('/ponyprofile/{{ $found2->ponyid }}')" style="cursor: pointer;"  title="{{ $found2->name }}" class="mx-auto w-[100px]" src="{{asset('ponys/baby/'. $found2->ponyid.'.png')}}">
                </li>
                @endfor
                @else
                <li>None</li>
                @endif

            </ul>
        </div>
    </div>

    <!--PONY LINEAGE CHART-->
    <h4 class="text-center text-xs  sm:text-lg font-bold">Inbreeding: {{$pony[0]["inbred"]}}%</h4>
    <div class="border border-sky-400 rounded-lg p-2">
        <table class="table w-full  rounded-lg border-gray-400">
        <tr>
            <td class="border  border-t-0 border-gray-400  w-[180px]" colspan="4">
                @if($lineage[0]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[0]}}')" style="cursor: pointer;"  class="mx-auto w-[180px]" src="{{asset('ponys/adult/'. $lineage[0].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>
            <td class="border  border-t-0 border-gray-400  w-[180px]" colspan="4">
                @if($lineage[1]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[0]}}')" style="cursor: pointer;" class="mx-auto w-[180px]" src="{{asset('ponys/adult/'. $lineage[1].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>

        </tr>

        <tr>

            <td class="border  border-gray-400 w-[150px]" colspan="2">
                @if($lineage[2]!=0) 
                <img onclick="loadPartial('/ponyprofile/{{$lineage[2]}}')" style="cursor: pointer;" class="mx-auto w-[150px]" src="{{asset('ponys/adult/'. $lineage[2].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>
            <td class="border  border-gray-400 w-[150px]" colspan="2">
                @if($lineage[3]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[3]}}')" style="cursor: pointer;" class="mx-auto w-[150px]" src="{{asset('ponys/adult/'. $lineage[3].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>
            <td class="border  border-gray-400 w-[150px]" colspan="2">
                @if($lineage[8]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[8]}}')" style="cursor: pointer;" class="mx-auto w-[150px]" src="{{asset('ponys/adult/'. $lineage[8].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
            <td class="border  border-gray-400 w-[150px]" colspan="2">
                @if($lineage[9]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[9]}}')" style="cursor: pointer;" class="mx-auto w-[150px]" src="{{asset('ponys/adult/'. $lineage[9].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>             
        </tr>

        <tr>
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[4]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[4]}}')" style="cursor: pointer;" class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[4].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[5]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[5]}}')" style="cursor: pointer;" class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[5].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[6]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[6]}}')" style="cursor: pointer;" class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[6].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[7]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[7]}}')" style="cursor: pointer;" class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[7].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[10]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[10]}}')" style="cursor: pointer;" class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[10].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[11]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[11]}}')" style="cursor: pointer;" class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[11].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[12]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[12]}}')" style="cursor: pointer;" class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[12].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>  
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[13]!=0)
                <img onclick="loadPartial('/ponyprofile/{{$lineage[13]}}')" style="cursor: pointer;" class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[13].'.png')}}">
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
        </tr>


    </table><!--END PONY LINEAGE CHART-->
    </div> 
</div>