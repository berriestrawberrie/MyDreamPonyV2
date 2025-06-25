@extends('layouts.app')

@section('page-title')
Contests
@endsection

@section('page-content')

    

The contests will begin here!
<button>Sign Up Ponies for Contests</button>
<a href="/createContest"><button>Create a Contest</button></a>

@include('contest.components.upcoming')



@endsection