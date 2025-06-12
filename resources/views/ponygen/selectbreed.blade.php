@extends('layouts.app')

@section('page-title')
Select A Breed!
@endsection

@section('page-content')


<table class="text-xs md:text-sm text-center mb-10">
    @for($i=3; $i>=0;$i--)
        <tr>
            <td><img src="{{asset('site/breeds/female'.$ponys[$i]["typeName"].'.png')}}"></td>
            <td>
                <a href="/ponygen/generate/{{$ponys[$i]["typeName"]}}"><button>Generate</button></a>
            </td>
            <td><img src="{{asset('site/breeds/male'.$ponys[$i]["typeName"].'.png')}}"></td>
        </tr>
        <tr>
            <td colspan="3">
                {{$ponys[$i]["backstory"]}}
            </td>
        </tr>
    @endfor
</table>
@endsection