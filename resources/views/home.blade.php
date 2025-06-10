@extends('layouts.app')

@section('page-title')
Welcome!
@endsection

@section('page-content')

<a href="/register"><button>Register!</button></a>

@if(Auth::user())
    <form class="mx-auto w-fit rounded-lg border" action="{{route('logout')}}" method="POST">
        @csrf
        @method('POST')
        <button type="submit" class="button-8">Logout</button>
    </form>
@else
    <form class="mx-auto w-fit rounded-lg border" method="POST" action="{{route('login')}}">
        @csrf
        @method('Post')
        <fieldset>
            <legend>Username</legend>
            <input type="text" name="name" placeholder="username" class="userholder">
        </fieldset>
        <fieldset>
            <legend>Password</legend>
            <input type="text" name="password" placeholder="password" class="userholder">
        </fieldset>
        <button type="submit" >Login</button>
    </form>
@endif



@endsection