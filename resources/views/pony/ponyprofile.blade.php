@extends('layouts.app')

@section('page-title'){{$pony[0]["name"]}}@endsection

@section('page-content')
<!--NEXT/PREVIOUS PONY ARROWS-->
<div class=" flex justify-between -mb-2">
    <a href="/previouspony/{{ $pony[0]["stable_assign"] }}/{{ $pony[0]["ponyid"] }}"><img class="hover:brightness-115" src="{{asset('site/caret-left.png')}}" ></a>
    <a href="/nextpony/{{ $pony[0]["stable_assign"] }}/{{ $pony[0]["ponyid"] }}""><img class="hover:brightness-115 " src="{{asset('site/caret.png')}}" ></a>
</div>

<div class="flex flex-col xl:flex-row xl:justify-evenly mb-[50px]">
    @if($pony[0]["age"]>=14)
        @if($pony[0]["modified"]>0)
        <img src="{{asset('ponys/mod/'.$pony[0]["image"])}}?{{uniqid()}}">
        @else
        <img src="{{asset('ponys/adult/'.$pony[0]["image"])}}?{{uniqid()}}">
        @endif

    @else
        <img src="{{asset('ponys/baby/'.$pony[0]["image"])}}?{{uniqid()}}">
    @endif
    @include('pony.components.ponystats')
</div>

@include('pony.components.ponytabs')


    <script type="text/javascript" src="{{ asset('js/ponyprofile.js') }}">
    </script>

@endsection