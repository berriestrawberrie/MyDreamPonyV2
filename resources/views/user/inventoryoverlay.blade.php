@extends('layouts.overlay')

@section('overlay-content')

<div class="w-4/5 rounded-4xl h-[600px] bg-white mx-auto mt-[100px]">
<div id="tabs">
  <ul id="tabs-ul" >
    <li class="tabs-li"><a href="#tabs-1">Food</a></li>
    <li class="tabs-li"><a href="#tabs-2">Ponyware</a></li>
    <li class="tabs-li"><a href="#tabs-3">Outfits</a></li>
    <li class="tabs-li"><a href="#tabs-4">Consumeables</a></li>
  </ul>
  <div id="tabs-1">
    @include('user.components.food')
  </div>
  <div id="tabs-2">
    @include('user.components.ponyware')
  </div>
  <div id="tabs-3">
    @include('user.components.outfits')
     </div>
  <div id="tabs-4">
    @include('user.components.consumables')
    </div>
    
</div>



</div>


    <script type="text/javascript" src="{{ asset('js/inventoryoverlay.js') }}">
    </script>

@endsection