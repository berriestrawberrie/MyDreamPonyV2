<div class='w-full relative  bg-white md:w-3/4 md:shadow-lg md:rounded-4xl p-4 pt-[50px] md:mx-auto'>

            <div class='float absolute left-0 -top-[70px] md:-left-[70px] md:-top-[90px] '>
                <span class='page text-3xl md:text-5xl' id="page-title">
                    <!--THIS IS WHERE THE PAGES TITLE-->
                    Welcome!
                </span>
                <img class=" w-[150px] md:w-[200px] -mt-8 md:-mt-10" src="{{asset('site/cloud.png')}}">
            </div>

            <div ><!--STUFF DIV-->
              
                <!--NURSERY INFORMATION-->
                <div class="border w-full relative h-[540px] mb-4">
                    <img class="hidden absolute -top-[90px] right-0 md:block"src="{{asset('site/nursery.png')}}">
                </div>
                    
                <ul class="sortable list-none flex flex-wrap justify-center gap-2">
                    @foreach($ponys as $pony)
                        <li class="rounded-2xl" data-index="{{$pony->ponyid}}" data-position="{{$pony->stable_ord}}">
                            @include('pony.components.ponycard')
                        </li>
                    @endforeach

                </ul>

            </div><!--END OF STUFF DIV-->
        </div><!--END OF PAGE DIV-->




    <script type="text/javascript" src="{{ asset('js/stables.js') }}">
    </script>

