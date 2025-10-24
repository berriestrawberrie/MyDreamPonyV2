@extends('layouts.app')

@section('page-title')
Contests
@endsection

@section('page-content')

<div class=" flex-col-reverse lg:flex-row ">

<div class=" mb-2 flex justify-between">
    <div class="border">
        <img class="w-sm" src="{{asset('/site/castle.png')}}">
    </div>
    <div class="border w-1/2 flex justify-center items-center">
        <button>Create Contest</button>
         <button>Training</button>
    </div>

</div>
<div class="border mb-2">
    This will be the contests that are available for the hour?
</div>



</div>


@endsection