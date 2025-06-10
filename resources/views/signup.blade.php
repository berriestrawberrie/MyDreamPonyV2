@extends('layouts.app')

@section('page-title')
Sign Up!
@endsection

@section('page-content')
    <form class='register w-4/5 mx-auto p-3' method="POST" action="">
        @csrf
        @method('Post')
        <fieldset>
            <label for="email" >Email address</label>
            <input type="email"  name="email" id="email" placeholder="email address">
        </fieldset>
        <fieldset>
            <label for="name" >Username</label>
            <input type="text" id="name" name="name">
            <button type="button">Check</button>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </fieldset>
        <fieldset>
            <label for="birthday" >Birthday</label>
            <input type="date"  id="birthday" name="birthday">
        </fieldset>
        <fieldset>

            <div>
                <input type="checkbox" id="ToS">
                <label for="ToS">Agree to the<a href="">Terms of Service</a></label>
            </div>
            <div>
                <input type="checkbox" id="Rules">
                <label for="Rules">Agree to the<a href="">Rules</a></label>
            </div>
        </fieldset>
        <button type="submit" >Submit</button>
    
    </form>
</div>
@endsection