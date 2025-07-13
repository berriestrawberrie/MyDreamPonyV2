@extends('layouts.appopen')

@section('page-title')

@endsection

@section('page-content')
    <div class="mt-4 w-full lg:mx-auto lg:w-4/5 bg-white border p-2">

    <form method="POST" action="/updatepost/{{$post[0]["id"]}}" enctype="multipart/form-data">
        @csrf
        <label for="post-content">Edit Post #{{$post[0]["id"]}}:</label>
        <div class="w-full flex gap-2">
            <button class="edit-btn" id="bold">Bold</button>
            <button class="edit-btn" id="italic">Italic</button>
            <button class="edit-btn" id="underline">Underline</button>
            <button class="edit-btn" id="center">Center</button>
            <button class="edit-btn" id="quote">Quote</button>
            <button class="edit-btn" id="image">Image</button>
            <button class="edit-btn" id="link">Link</button>
            <button class="edit-btn" id="spoiler">Spoiler</button>
        </div>
        <textarea rows="15" class="w-full border border-sky-400 overflow-auto p-1" name="post-content" id="post-content" required> {{$post[0]["bbc_content"]}}</textarea>
        <div class="flex justify-end">
            <button type="submit">Post</button>
        </div>

    </forum>
    </div>

    <script type="text/javascript" src="{{ asset('js/editpost.js') }}">
    </script>
@endsection