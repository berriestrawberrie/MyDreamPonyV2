@extends('layouts.appopen')

@section('page-title')
Forums
@endsection

@section('page-content')
<!--HEADER -->
<div class="bg-cloud h-[40px] -mt-6 rounded-2xl ">
<ul class="flex ms-8">
    <li class="hover:bg-white h-[40px] px-3">Main</li>
    <li class="hover:bg-white h-[40px] px-3">Latest</li>
    <li class="hover:bg-white h-[40px] px-3">Saved</li>
    <li class="hover:bg-white h-[40px] px-3">My Posts</li>
</ul>
</div>
<div class="mx-auto w-4/5">
    <!--CATEGORIES-->
    <h3>News & Announcements</h3>
        <div>
            <table class="border w-full">
                <tr>
                    <td>
                        <img class="w-[90px]" src="{{asset('site/news.png')}}">
                    </td>
                    <td>
                        <span>Category Title </span>
                        <p>Category description will be here</p>
                    </td>
                    <td>Thread#</td>
                    <td>Post#</td>
                    <td class="text-right"><span>Lastest Post</span>
                        <p>Welcome to blah blah..</p>
                    </td>
                </tr>
                                <tr>
                    <td>
                        <img class="w-[90px]" src="{{asset('site/cooking.png')}}">
                    </td>
                    <td>
                        <span>Category Title </span>
                        <p>Category description will be here</p>
                    </td>
                    <td>Thread#</td>
                    <td>Post#</td>
                    <td class="text-right"><span>Lastest Post</span>
                        <p>Welcome to blah blah..</p>
                    </td>
                </tr>
            </table>
        </div>
</div>

            

@endsection
