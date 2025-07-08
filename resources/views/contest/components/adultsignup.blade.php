<form method="POST" action="/signup/{{$contest[0]["token"]}}">
    @csrf
<div class="flex justify-evenly">
    @for($i=0;$i<count($adults);$i++)

    <div class="border  w-1/5">
        <label for="{{$adults[$i]}}" class="capitalize">{{$adults[$i]}}</label>
            @foreach($adultponys as $pony)
            <div>
                <input class="" type="checkbox" value="{{$pony->ponyid}}" id="{{$pony->ponyid.$adults[$i]}}" name="adults[]">
                <label for="{{$pony->ponyid.$adults[$i]}}">{{$pony->name}}: #{{$pony->ponyid}}</label>
            </div>
            @endforeach

    </div>

    @endfor
</div>
<div class="flex justify-evenly">
    @for($i=0;$i<count($babys);$i++)

    <div class="border  w-1/5">
        <label for="{{$babys[$i]}}" class="capitalize">{{$babys[$i]}}</label>
            @foreach($babyponys as $pony)
            <div>
                <input class="" type="checkbox" value="{{$pony->ponyid}}" id="{{$pony->ponyid.$babys[$i]}}" name="babys[]">
                <label for="{{$pony->ponyid.$babys[$i]}}">{{$pony->name}}: #{{$pony->ponyid}}</label>
            </div>
            @endforeach

    </div>

    @endfor
</div>
<button type="submit" id="massAdult">Mass SignUp</button>
</form>