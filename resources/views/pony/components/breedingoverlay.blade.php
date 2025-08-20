@extends('layouts.overlay')

@section('overlay-content')


<div class="w-4/5 rounded-4xl h-4/5 bg-white mx-auto mt-[100px]">
<div id="tabs">
  <ul id="tabs-ul" >
    <li class="tabs-li"><a href="#tabs-1">
      <span class="hidden sm:block">Breed?</span>
      <img class="sm:hidden -rotate-15 w-[20px] h-[20px]" src="/item/21/icon">
    </a></li>

  </ul>
  @include('layouts.alerts')
  <div id="tabs-1">
        <h3 class="text-center text-4xl bubble text-sky-400">Confirm the Breeding?</h3>
    <div class="flex justify-center">
        <img  src="{{asset('ponys/adult/'.$ponys[0]["ponyid"].'.png')}}">
                <img src="{{asset('ponys/adult/'.$ponys[1]["ponyid"].'.png')}}">
    </div>
    <div class="text-center">
        <p>The dam will receive the offspring around: {{date_format($birth, 'Y-m-d H:m:s')}}</p>
    </div>
    <form method="POST" action="/submitBreed/average" enctype="multipart/form-data">
        @csrf
    <button class="float-right">Confirm Breeding</button>
    <input class="hidden" type="number" value="{{$ponys[0]["ponyid"]}}" name="breeder1">
    <input class="hidden" type="number" value="{{$ponys[1]["ponyid"]}}" name="breeder2">    
    </button>
  </div><!--END OF TAB-->

    
</div>



</div>

    <script type="text/javascript" src="{{ asset('js/breedoverlay.js') }}">
    </script>
@endsection