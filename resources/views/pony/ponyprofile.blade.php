@extends('layouts.app')

@section('page-title'){{$pony[0]["name"]}}@endsection

@section('page-content')

<div class="flex flex-col xl:flex-row xl:justify-evenly mb-[50px]">
    <img src="/pony/image/{{$pony[0]["ponyid"]}}">
    @include('pony.components.ponystats')
</div>
@include('pony.components.ponytabs')


    <script type="text/javascript" src="{{ asset('js/ponyprofile.js') }}">
    </script>

@endsection