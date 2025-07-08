@extends('layouts.overlay')

@section('overlay-content')

<div class="w-4/5 rounded-4xl h-4/5 bg-white mx-auto mt-[100px]">
<div id="tabs">
  <ul id="tabs-ul" >
    <li class="tabs-li"><a href="#tabs-1">
      <span class="hidden sm:block">Food</span>
      <img class="sm:hidden -rotate-15 w-[20px] h-[20px]" src="/item/21/icon">
    </a></li>
    <li class="tabs-li"><a href="#tabs-2">
      <span class="hidden sm:block">Ponyware</span>
      <img class="sm:hidden  w-[20px] h-[20px]" src="/item/9/icon">
    </a></li>
    <li class="tabs-li"><a href="#tabs-3">
      <span class="hidden sm:block">Outfit</span>
      <img class="sm:hidden  w-[20px] h-[20px]" src="/item/28/icon">
    </a></li>
    <li class="tabs-li"><a href="#tabs-4">
      <span class="hidden sm:block">Consumables</span>
      <img class="sm:hidden  w-[20px] h-[20px]" src="/item/26/icon">
    </a></li>
  </ul>
  @include('layouts.alerts')
  <div id="tabs-1">
    @include('user.components.food')
  </div>
  <div id="tabs-2">
    @include('user.components.ponyware')
  </div>
  <div id="tabs-3">

     </div>
  <div id="tabs-4">

    </div>
    
</div>



</div>


    <script type="text/javascript" src="{{ asset('js/inventoryoverlay.js') }}">
    </script>

@endsection