@extends('layouts.app')

@section('page-title')
Nursery
@endsection

@section('page-content')
    <!--NURSERY INFORMATION-->
    <div class="border w-full relative h-[540px] mb-4">
        <img class="hidden absolute -top-[90px] right-0 md:block"src="{{asset('site/nursery.png')}}">
    </div>
        
    <ul class="sortable list-none flex flex-wrap justify-center gap-2">
        @foreach($ponys as $pony)
            <li class="rounded-2xl" data-index="{{$pony->ponyid}}" data-position="{{$pony->stable_ord}}">
                @include('pony.components.ponycard')
            </li>
        @endforeach

    </ul>

    <script type="text/javascript" src="{{ asset('js/stables.js') }}">
    </script>
@endsection
