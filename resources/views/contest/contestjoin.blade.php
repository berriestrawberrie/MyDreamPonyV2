@extends('layouts.app')

@section('page-title')
Contests
@endsection

@section('page-content')

    <div class="border">
        This will contain the contest information
    </div>
    @include('contest.components.enteredponies')

    @include('contest.components.adultsignup')


    <script type="text/javascript" src="{{ asset('js/contest.js') }}">
    </script>

@endsection