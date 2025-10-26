        <div class='w-full relative  bg-white md:w-3/4 md:shadow-lg md:rounded-4xl p-4 pt-[50px] md:mx-auto'>

            <div class='float absolute left-0 -top-[70px] md:-left-[70px] md:-top-[90px] '>
                <span class='page text-3xl md:text-5xl' id="page-title">
                    <!--THIS IS WHERE THE PAGES TITLE-->
                </span>
                <img class=" w-[150px] md:w-[200px] -mt-8 md:-mt-10" src="{{asset('site/cloud.png')}}">
            </div>

            <div >
                <button onclick="loadPartial('/ponygen/selectbreed')">Cancel</button></a>
                <form method="POST" action="{{route('generate.pony')}}">
                    @csrf
                    @method('POST')
                    <fieldset class="flex flex-col  border items-center justify-evenly mb-4 md:flex-row">
                        <img class="w-[190px] h-[160px]" src="/generator/icon/{{$type}}">
                        <input class="hidden" type="text" name="breed" value="{{$type}}">
                        <div class="md:w-1/2">
                            <div class="selection-icon flex w-full justify-evenly items-center">
                                <label for="female">
                                <input type="radio" name="sex" id="female" value="female" checked>
                                <img src="{{asset('site/femaledesign.png')}}" title="Female">
                                </label>

                                <label for="male">
                                <input type="radio" name="sex" id="male" value="male">
                                <img src="{{asset('site/malesign.png')}}" title="Male">
                                </label>
                            </div>
                            <div class="flex flex-wrap justify-evenly">
                                <label class="flex flex-col items-center" for="eyes">Eyes:
                                <input class="h-[40px] w-[40px]" type="color" value="#000000" name="eyes" id="eyes">
                                </label>
                                <label class="flex flex-col items-start" for="hair">Hair:
                                    <div>
                                        <input class="h-[40px] w-[40px]" type="color" value="#000000" name="hair" id="hair">
                                        <input class="h-[40px] w-[40px]" type="color" value="#000000" name="hair2" id="hair2">
                                    </div>
                                </label>
                                <label class="flex flex-col items-start" for="accent">Accent:
                                    <div>
                                        <input class="h-[40px] w-[40px]" type="color" value="#000000" name="accent" id="accent">
                                        <input class="h-[40px] w-[40px]" type="color" value="#000000" name="accent2" id="accent2">
                                    </div>
                                </label>
                                <label class="flex flex-col items-center" for="coat">Coat:
                                <input class="h-[40px] w-[40px]" type="color" value="#000000" name="coat" id="coat">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div class="flex justify-evenly w-full gap-4">
                        <!--SPECIAL TRAITS FOR DAM-->
                        <fieldset class="border p-1">
                            <h2>Hair Traits</h2>
                                <hr>
                                <div class="flex">
                                    @foreach($traits as $trait)
                                        @if($trait["traittype"]=="hair")
                                            <label for="{{$trait["traitname"]}}">
                                            <input type="radio" id="{{$trait["traitname"]}}" name="specialtrait1" value="{{$trait["traitname"]}}">
                                            
                                            <img title="{{$trait["traitname"]}}"  class="md:w-48" src="/trait/genform/{{$trait["traitid"]}}"></label>
                                        @endif
                                    @endforeach
                                </div>
                            <h2>Face Traits</h2>
                                <hr>
                                <div class="flex text-center">
                                    @foreach($traits as $trait)
                                        @if($trait["traittype"]=="face")
                                            <label for="{{$trait["traitname"]}}">
                                            <input type="radio" id="{{$trait["traitname"]}}" name="specialtrait1" value="{{$trait["traitname"]}}">
                                            
                                            <img  title="{{$trait["traitname"]}}"  class="md:w-48" src="/trait/genform/{{$trait["traitid"]}}"></label>
                                        @endif
                                    @endforeach
                                </div>
                            <h2>Body Traits</h2>
                                <hr>
                                <div class="flex text-center">
                                    @foreach($traits as $trait)
                                        @if($trait["traittype"]=="body")
                                            <label for="{{$trait["traitname"]}}">
                                            <input type="radio" id="{{$trait["traitname"]}}" name="specialtrait1" value="{{$trait["traitname"]}}">
                                            
                                            <img  title="{{$trait["traitname"]}}"  class="md:w-48" src="/trait/genform/{{$trait["traitid"]}}"></label>
                                        @endif
                                    @endforeach
                                </div>
                            <h2>Leg Traits</h2>
                                <hr>
                                <div class="flex text-center">
                                    @foreach($traits as $trait)
                                        @if($trait["traittype"]=="leg")
                                            <label for="{{$trait["traitname"]}}">
                                            <input type="radio" id="{{$trait["traitname"]}}" name="specialtrait1" value="{{$trait["traitname"]}}">
                                            
                                            <img  title="{{$trait["traitname"]}}"  class="md:w-48" src="/trait/genform/{{$trait["traitid"]}}"></label>
                                        @endif
                                    @endforeach
                                </div>
                        </fieldset>
                        <!--SPECIAL TRAITS FOR SIRE-->
                        <fieldset class="border p-1">
                            <h2>Hair Traits</h2>
                                <hr>
                                <div class="flex text-center">
                                    @foreach($traits as $trait)
                                        @if($trait["traittype"]=="hair")
                                            <label for="{{$trait["traitname"]}}2">
                                            <input type="radio" id="{{$trait["traitname"]}}2" name="specialtrait2" value="{{$trait["traitname"]}}">
                                            
                                            <img title="{{$trait["traitname"]}}"  title="{{$trait["traitname"]}}"  class="md:w-48" src="/trait/genform/{{$trait["traitid"]}}"></label>
                                        @endif
                                    @endforeach
                                </div>
                            <h2>Face Traits</h2>
                                <hr>
                                <div class="flex text-center">
                                    @foreach($traits as $trait)
                                        @if($trait["traittype"]=="face")
                                            <label for="{{$trait["traitname"]}}2">
                                            <input type="radio" id="{{$trait["traitname"]}}2" name="specialtrait2" value="{{$trait["traitname"]}}">
                                            
                                            <img title="{{$trait["traitname"]}}"   class="md:w-48" src="/trait/genform/{{$trait["traitid"]}}"></label>
                                        @endif
                                    @endforeach
                                </div>
                            <h2>Body Traits</h2>
                                <hr>
                                <div class="flex text-center">
                                    @foreach($traits as $trait)
                                        @if($trait["traittype"]=="body")
                                            <label for="{{$trait["traitname"]}}2">
                                            <input type="radio" id="{{$trait["traitname"]}}2" name="specialtrait2" value="{{$trait["traitname"]}}">
                                            
                                            <img title="{{$trait["traitname"]}}"  class="md:w-48" src="/trait/genform/{{$trait["traitid"]}}"></label>
                                        @endif
                                    @endforeach
                                </div>
                            <h2>Leg Traits</h2>
                                <hr>
                                <div class="flex text-center">
                                    @foreach($traits as $trait)
                                        @if($trait["traittype"]=="leg")
                                            <label for="{{$trait["traitname"]}}2">
                                            <input type="radio" id="{{$trait["traitname"]}}2" name="specialtrait2" value="{{$trait["traitname"]}}">
                                            
                                            <img title="{{$trait["traitname"]}}"  class="md:w-48" src="/trait/genform/{{$trait["traitid"]}}"></label>
                                        @endif
                                    @endforeach
                                </div>

                        </fieldset>
                    </div>
                    <button type="submit">Submit</button>
                </form>


            </div>

        </div><!--END OF PAGE DIV-->







