<div>
    <div class="flex justify-around items-center">
        <div class="relative p-2  w-1/2">
            <div>
                <h4 class="text-xs sm:text-lg font-bold" >Fillies:{{count($filly)}}</h4>
            </div>
            <ul class="p-1  border border-sky-400 rounded-lg flex flex-wrap justify-center items-center h-24 overflow-auto">
                @if($filly)
                @for($i=0 ; $i< count($filly); $i++)
                <li>
                    @php
                    $found1 = collect($babies)->firstWhere('token', $filly[$i]);
                    @endphp
                    <a href="/ponyprofile/{{ $found1->ponyid }}">
                        <img title="{{ $found1->name }}" class="mx-auto w-[100px]" src="{{asset('ponys/baby/'. $found1->ponyid.'.png')}}">
                    </a>
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
                    <a href="/ponyprofile/{{ $found2->ponyid }}">
                        <img  title="{{ $found2->name }}" class="mx-auto w-[100px]" src="{{asset('ponys/baby/'. $found2->ponyid.'.png')}}">
                    </a>
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
                <a href="/ponyprofile/{{$lineage[0]}}"> 
                <img title="testing" class="mx-auto w-[180px]" src="{{asset('ponys/adult/'. $lineage[0].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>
            <td class="border  border-t-0 border-gray-400  w-[180px]" colspan="4">
                @if($lineage[1]!=0)
                <a href="/ponyprofile/{{$lineage[0]}}"> 
                <img class="mx-auto w-[180px]" src="{{asset('ponys/adult/'. $lineage[1].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>

        </tr>

        <tr>

            <td class="border  border-gray-400 w-[150px]" colspan="2">
                @if($lineage[2]!=0)
                <a href="/ponyprofile/{{$lineage[2]}}"> 
                <img class="mx-auto w-[150px]" src="{{asset('ponys/adult/'. $lineage[2].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>
            <td class="border  border-gray-400 w-[150px]" colspan="2">
                @if($lineage[3]!=0)
                <a href="/ponyprofile/{{$lineage[3]}}"> 
                <img class="mx-auto w-[150px]" src="{{asset('ponys/adult/'. $lineage[3].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>
            <td class="border  border-gray-400 w-[150px]" colspan="2">
                @if($lineage[8]!=0)
                <a href="/ponyprofile/{{$lineage[8]}}"> 
                <img class="mx-auto w-[150px]" src="{{asset('ponys/adult/'. $lineage[8].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
            <td class="border  border-gray-400 w-[150px]" colspan="2">
                @if($lineage[9]!=0)
                <a href="/ponyprofile/{{$lineage[9]}}"> 
                <img class="mx-auto w-[150px]" src="{{asset('ponys/adult/'. $lineage[9].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>             
        </tr>

        <tr>
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[4]!=0)
                <a href="/ponyprofile/{{$lineage[4]}}"> 
                <img class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[4].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[5]!=0)
                <a href="/ponyprofile/{{$lineage[5]}}"> 
                <img class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[5].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[6]!=0)
                <a href="/ponyprofile/{{$lineage[6]}}"> 
                <img class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[6].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[7]!=0)
                <a href="/ponyprofile/{{$lineage[7]}}"> 
                <img class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[7].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[10]!=0)
                <a href="/ponyprofile/{{$lineage[10]}}"> 
                <img class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[10].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[11]!=0)
                <a href="/ponyprofile/{{$lineage[11]}}"> 
                <img class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[11].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[12]!=0)
                <a href="/ponyprofile/{{$lineage[12]}}"> 
                <img class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[12].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td>  
            <td class="border border-b-0 border-gray-400 ">
                @if($lineage[13]!=0)
                <a href="/ponyprofile/{{$lineage[13]}}"> 
                <img class="mx-auto w-[90px]" src="{{asset('ponys/adult/'. $lineage[13].'.png')}}">
                </a>
                @else
                <img class="mx-auto h-[10px]" src="{{asset('ponys/adult/0.png')}}">
                @endif
            </td> 
        </tr>


    </table><!--END PONY LINEAGE CHART-->
    </div> 
</div>