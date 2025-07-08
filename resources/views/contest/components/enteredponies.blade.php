<div class="flex">
    <!--ADULT ACCORDION-->
    <div class="w-1/2 overflow-x-hidden" id="accordion">
            <h3 class="capitalize">
                @if(count($adult1) == $contest[0]['maxlimit'])
                <img class="w-[20px] inline-flex" src="{{asset('site/fulladultbutton.svg')}}">
                @else
                <img class="w-[20px] inline-flex" src="{{asset('site/adultbutton.svg')}}">
                @endif
                {{$adults[0]}} {{count($adult1)}} / {{$contest[0]['maxlimit']}}
            </h3>
            <div class="max-h-[200px] overflow-y-auto overflow-x-hidden">
                <table class="w-full">
                    <tr>
                        <td>Name(#ID)</td>
                        <td>Level</td>
                    </tr>
                   @foreach($adult1 as $pony)
                        <tr>
                            <td>{{$pony->name}} (#{{$pony->ponyid}})</td>
                            <td>{{$pony->level}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <h3 class="capitalize">
                @if(count($adult2) == $contest[0]['maxlimit'])
                <img class="w-[20px] inline-flex" src="{{asset('site/fulladultbutton.svg')}}">
                @else
                <img class="w-[20px] inline-flex" src="{{asset('site/adultbutton.svg')}}">
                @endif
                {{$adults[1]}} {{count($adult2)}} / {{$contest[0]['maxlimit']}}
            </h3>
            <div class="max-h-[200px] overflow-y-auto overflow-x-hidden">
                <table class="w-full">
                    <tr>
                        <td>Name(#ID)</td>
                        <td>Level</td>
                    </tr>
                   @foreach($adult2 as $pony)
                        <tr>
                            <td>{{$pony->name}} (#{{$pony->ponyid}})</td>
                            <td>{{$pony->level}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <h3 class="capitalize">
                @if(count($adult3) == $contest[0]['maxlimit'])
                <img class="w-[20px] inline-flex" src="{{asset('site/fulladultbutton.svg')}}">
                @else
                <img class="w-[20px] inline-flex" src="{{asset('site/adultbutton.svg')}}">
                @endif
                {{$adults[2]}} {{count($adult3)}} / {{$contest[0]['maxlimit']}}
            </h3>
            <div class="max-h-[200px] overflow-y-auto overflow-x-hidden">
                <table class="w-full">
                    <tr>
                        <td>Name(#ID)</td>
                        <td>Level</td>
                    </tr>
                   @foreach($adult3 as $pony)
                        <tr>
                            <td>{{$pony->name}} (#{{$pony->ponyid}})</td>
                            <td>{{$pony->level}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <h3 class="capitalize">
                @if(count($adult4) == $contest[0]['maxlimit'])
                <img class="w-[20px] inline-flex" src="{{asset('site/fulladultbutton.svg')}}">
                @else
                <img class="w-[20px] inline-flex" src="{{asset('site/adultbutton.svg')}}">
                @endif
                {{$adults[3]}} {{count($adult4)}} / {{$contest[0]['maxlimit']}}
            </h3>
            <div class="max-h-[200px] overflow-y-auto overflow-x-hidden">
                <table class="w-full">
                    <tr>
                        <td>Name(#ID)</td>
                        <td>Level</td>
                    </tr>
                   @foreach($adult4 as $pony)
                        <tr>
                            <td>{{$pony->name}} (#{{$pony->ponyid}})</td>
                            <td>{{$pony->level}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
    </div>



    <!--BABY ACCORDION-->
    <div class="w-1/2"  id="accordion2">
            <h3 class="capitalize">
                @if(count($baby1) == $contest[0]['maxlimit'])
                <img class="w-[20px] inline-flex" src="{{asset('site/fullbabybutton.svg')}}">
                @else
                <img class="w-[20px] inline-flex" src="{{asset('site/babybutton.svg')}}">
                @endif
                {{$babys[0]}} {{count($baby1)}} / {{$contest[0]['maxlimit']}}
            </h3>
            <div class="max-h-[200px] overflow-y-auto overflow-x-hidden">
                <table class="w-full">
                    <tr>
                        <td>Name(#ID)</td>
                        <td>Level</td>
                    </tr>
                   @foreach($baby1 as $pony)
                        <tr>
                            <td>{{$pony->name}} (#{{$pony->ponyid}})</td>
                            <td>{{$pony->level}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <h3 class="capitalize">
                @if(count($baby2) == $contest[0]['maxlimit'])
                <img class="w-[20px] inline-flex" src="{{asset('site/fullbabybutton.svg')}}">
                @else
                <img class="w-[20px] inline-flex" src="{{asset('site/babybutton.svg')}}">
                @endif
                {{$babys[1]}} {{count($baby2)}} / {{$contest[0]['maxlimit']}}
            </h3>
            <div class="max-h-[200px] overflow-y-auto overflow-x-hidden">
                <table class="w-full">
                    <tr>
                        <td>Name(#ID)</td>
                        <td>Level</td>
                    </tr>
                   @foreach($baby2 as $pony)
                        <tr>
                            <td>{{$pony->name}} (#{{$pony->ponyid}})</td>
                            <td>{{$pony->level}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <h3 class="capitalize">
                @if(count($baby3) == $contest[0]['maxlimit'])
                <img class="w-[20px] inline-flex" src="{{asset('site/fullbabybutton.svg')}}">
                @else
                <img class="w-[20px] inline-flex" src="{{asset('site/babybutton.svg')}}">
                @endif
                {{$babys[2]}} {{count($baby3)}} / {{$contest[0]['maxlimit']}}
            </h3>
            <div class="max-h-[200px] overflow-y-auto overflow-x-hidden">
                <table class="w-full">
                    <tr>
                        <td>Name(#ID)</td>
                        <td>Level</td>
                    </tr>
                   @foreach($baby3 as $pony)
                        <tr>
                            <td>{{$pony->name}} (#{{$pony->ponyid}})</td>
                            <td>{{$pony->level}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <h3 class="capitalize">
                @if(count($baby4) == $contest[0]['maxlimit'])
                <img class="w-[20px] inline-flex" src="{{asset('site/fullbabybutton.svg')}}">
                @else
                <img class="w-[20px] inline-flex" src="{{asset('site/babybutton.svg')}}">
                @endif
                {{$babys[3]}} {{count($baby4)}} / {{$contest[0]['maxlimit']}}
            </h3>
            <div class="max-h-[200px] overflow-y-auto overflow-x-hidden">
                <table class="w-full">
                    <tr>
                        <td>Name(#ID)</td>
                        <td>Level</td>
                    </tr>
                   @foreach($baby4 as $pony)
                        <tr>
                            <td>{{$pony->name}} (#{{$pony->ponyid}})</td>
                            <td>{{$pony->level}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
    </div>

</div>    