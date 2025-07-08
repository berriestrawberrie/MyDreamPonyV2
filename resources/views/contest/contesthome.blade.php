@extends('layouts.app')

@section('page-title')
Contests
@endsection

@section('page-content')

<div class=" flex-col-reverse lg:flex-row">

    <!--CREATE A CONTEST-->
    <div class="lg:w-1/2 p-2">
        <h2 class="bubble text-4xl text-sky-400">My Upcoming Contest</h2>
        <table class="w-full  text-center">
            <tr>
                <th>Time:</th>
                <th>Contest Type</th>
                <th>Contest Name</th>
                <th>Sign Up</th>
            </tr>
            @if(count($contest) == 0)
            <tr>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
            </tr>
            @else
            <tr>
                <td>{{$contest[0]["runtime"]}}</td>
                <td>--</td>
                <td>--</td>
                <td><a href="../joincontest/{{$contest[0]["token"]}}">Join</a></td>
            </tr>
            @endif

        </table>
        
        @if(count($contest)==0)
            <div class="border rounded-2xl mt-2 p-2">
            @include('contest.components.createcontest')
            </div>
        @else
            <form method="POST" action="/cancel/{{$contest[0]["token"]}}">
                @csrf
                <button>Cancel Contest</button>
            </form>
        @endif
    </div>


    <!--THE CONTESTS QUEUE-->
    <div class="h-[400px] lg:w-1/2 overflow-y-auto">
    @include('contest.components.upcoming')
    </div>


</div>


@endsection