<div>

    <form method="POST" action="/prebreed" enctype="multipart/form-data">
        @csrf
        <fieldset class="flex border justify-evenly items-center">
            <div>
                <label for="breeder">Breeding Partner:</label>
                <input class="hidden" type="text" value="{{$pony[0]["ponyid"]}}" name="breeder1">
                <select id="breeder2" name="breeder2" onchange="selectMate()">

                    @foreach($owned as $item)
                        <option value="{{$item->ponyid}}">{{$item->sex}}: {{$item->name}}(#{{$item->ponyid}})</option>
                    @endforeach
                    
                </select>
                <button id="breed-confirm">Breed</button>
            </div>
            <div>
                <img id="breeder-img" src="/ponys/adult/{{$owned[0]["ponyid"]}}.png">
            </div>

        </fieldset>

    </form>

</div>

