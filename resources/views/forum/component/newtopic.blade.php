
    <div id="topicpop" class=" hidden w-screen h-screen fixed top-0 left-0 bg-gray-500/50 z-99">
    
    <!--TOPIC FORM-->
    <div id="newtopic" class="absolute top-[25%] left-[10%] lg:left-[25%] w-3/4 lg:w-2/5 bg-white border rounded-2xl">
        <form class="w-fll p-2" method="POST" action="/newtopic/{{$category_id}}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <label for="subject">Topic(*):</label>
            <input class="w-full border rounded-lg p-1 border-sky-400" type="text" id="subject" name="subject" placeholder="max:(50)chars" required maxlength="50">
            <label for="content">Message(*):</label>
            <textarea id="content" name="content" rows="6" cols="6" class="w-full border rounded-lg border-sky-400">
            </textarea>
            <button class="float-end mb-2" type="submit">Post</button>
        </form>
        <img class="hover:brightness-120 absolute -top-[30px] -right-[20px]" id="canceltopic" src="{{asset('site/closebutton.png')}}">
    </div>



</div>
