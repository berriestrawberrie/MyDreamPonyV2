@extends('layouts.appopen')

@section('page-title')
{{$user[0]["stable1"]}}
@endsection

@section('page-content')


        
    <ul class="sortable list-none flex flex-wrap justify-center gap-2 h-[800px] overflow-visible">
        @foreach($ponys as $pony)
            <li class="rounded-2xl" data-index="{{$pony->ponyid}}" data-position="{{$pony->stable_ord}}">
                @include('pony.components.ponypedal')
            </li>
        @endforeach

    </ul>

    <script type="text/javascript" src="{{ asset('js/stables.js') }}">
    </script>
@endsection
