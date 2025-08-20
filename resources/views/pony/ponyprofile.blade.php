@extends('layouts.app')

@section('page-title'){{$pony[0]["name"]}}@endsection

@section('page-content')

<div class="flex flex-col xl:flex-row xl:justify-evenly mb-[50px]">
    @if($pony[0]["age"]>=14)
        <img src="{{asset('ponys/adult/'.$pony[0]["image"])}}?{{uniqid()}}">
    @else
        <img src="{{asset('ponys/baby/'.$pony[0]["image"])}}?{{uniqid()}}">
    @endif
    @include('pony.components.ponystats')
</div>
@include('pony.components.ponytabs')


    <script type="text/javascript" src="{{ asset('js/ponyprofile.js') }}">
    </script>

@endsection