@if(count($allcontest)>0)
    @foreach($allcontest as $item)
        <a href="../joincontest/{{$item->token}}"><div class=" rounded-3xl p-2 w-[420px] mx-auto ">
            <h3 class="font-bold inline">{{$item->title}}</h3><span class="inline"> by #{{$item->userid}}</span>
            <div class="flex gap-2 justify-center items-center -mt-2 w-[400px] ">
                <!--CONTEST ICON-->
                <div class=" flex items-center justify-center bg-sky-100 w-[60px] h-[60px] mt-2 rounded-2xl border-2 border-sky-500 shadow-md">
                    <img class="contest-icon" src="{{asset('site/marathon.png')}}">
                </div>
                <!--CONTEST BANNER-->
                <div class="relative rounded-xl  w-4/5 max-w-[200px] max-h-[100px] overflow-x-hidden overflow-y-auto pt-2 shadow-md bg-transparent">
                    <!--FREE OR PAID-->
                    <div class="absolute right-2 top-0 bg-sky-200 px-2
                    rounded-sm border-2 border-sky-500 shadow-md">
                        @if($item->fee == "0")Free
                        @else
                        Paid
                        @endif
                    </div>
                    <img class="contest-banner" src="{{asset('uploads/temp/'.$item->banner)}}">
                </div>
                <!--CONTEST STATUSES-->
                <div class="w-[135px] flex justify-center mt-2">
                    <div class="w-1/2  flex justify-end flex-wrap ">
                        <img class="w-[30px]" src="{{asset('site/adultbutton.svg')}}">
                        <img class="w-[30px]" src="{{asset('site/fulladultbutton.svg')}}">
                        <img class="w-[30px]" src="{{asset('site/adultbutton.svg')}}">
                        <img class="w-[30px]" src="{{asset('site/adultbutton.svg')}}">
                    </div>
                    <div class="w-1/2  flex justify-start flex-wrap ">
                    <img class="w-[30px]" src="{{asset('site/babybutton.svg')}}">
                    <img class="w-[30px]" src="{{asset('site/fullbabybutton.svg')}}">
                    <img class="w-[30px]" src="{{asset('site/babybutton.svg')}}">
                    <img class="w-[30px]" src="{{asset('site/fullbabybutton.svg')}}">
                    </div>
                </div>
            </div>

        </div>
        </a>

    @endforeach
@else

--No Contests Upcoming --
@endif