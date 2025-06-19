@extends('layouts.app')

@section('page-title') Unnamed @endsection

@section('page-content')

<div class="flex gap-4">
    <div class="relative">
        <img class="w-lg" src="{{asset('ponygen/ponyimg-part0.png')}}">
        <img class="absolute top-0 w-lg" src="{{asset('ponygen/ponyimg-part1.png')}}">
        <img class="absolute top-0 w-lg" src="{{asset('ponygen/ponyimg-part2.png')}}">
        <img class="absolute top-0 w-lg" src="{{asset('ponygen/ponyimg-part3.png')}}">
        <img class="absolute top-0 w-lg" src="{{asset('ponygen/ponyimg-partspecialtrait.png')}}">
        <img class="absolute top-0 w-lg" src="{{asset('ponygen/ponyimg-part4.png')}}">
        <img class="absolute top-0 w-lg" src="{{asset('ponygen/ponyimg-part5.png')}}">
        <img class="absolute top-0 w-lg" src="{{asset('ponygen/ponyimg-part6.png')}}">
        <img class="absolute top-0 w-lg" src="{{asset('ponygen/ponyimg-part7.png')}}">
        <img class="absolute top-0 w-lg" src="{{asset('ponygen/ponyimg-part8.png')}}">
    </div>
    <table class="">
        <tr>
            <td>Eye:<br>
                #{{$hexcolors[0]}}</td>
            <td class="w-[100px] h-[40px]" style="background-color: #{{$hexcolors[0]}};"></td>
        </tr>
        <tr>
            <td>Hair:<br>
                #{{$hexcolors[1]}}</td>                
            <td class="w-[100px] h-[40px]" style="background-color: #{{$hexcolors[1]}};"></td>
        </tr>
        <tr>
            <td>Hair2:<br>
                #{{$hexcolors[2]}}</td>
            <td class="w-[100px] h-[40px]" style="background-color: #{{$hexcolors[2]}};"></td>
        </tr>
        <tr>
            <td>Accent<br>
                #{{$hexcolors[3]}}</td>
            <td class="w-[100px] h-[40px]" style="background-color: #{{$hexcolors[3]}};"></td>
        </tr>
        <tr>
            <td>Accent2<br>
                #{{$hexcolors[4]}}</td>
            <td class="w-[100px] h-[40px]" style="background-color: #{{$hexcolors[4]}};"></td>
        </tr>
        <tr>
            <td>Coat<br>
                #{{$hexcolors[5]}}</td>
            <td class="w-[100px] h-[40px]" style="background-color: #{{$hexcolors[5]}};"></td>
        </tr>
    </table>
    
</div>


@endsection