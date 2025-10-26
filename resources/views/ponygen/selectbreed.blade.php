        <div class='w-full relative  bg-white md:w-3/4 md:shadow-lg md:rounded-4xl p-4 pt-[50px] md:mx-auto'>

            <div class='float absolute left-0 -top-[70px] md:-left-[70px] md:-top-[90px] '>
                <span class='page text-3xl md:text-5xl' id="page-title">
                    <!--THIS IS WHERE THE PAGES TITLE-->
                    Select Type
                </span>
                <img class=" w-[150px] md:w-[200px] -mt-8 md:-mt-10" src="{{asset('site/cloud.png')}}">
            </div>

            <div >
                <table class="mx-auto text-xs md:text-sm text-center mb-10">


                        @foreach ($breeds as $breed)
                            <tr>
                                <td>
                                    <img src="{{ asset('site/breeds/female' . $breed['type'] . '.png') }}">
                                </td>
                                <td>

                                        <button onclick="loadPartial('/ponygen/generate/{{$breed['type']}}')" class="pony-button" data-type="{{$breed['type']}}">Generate</button>

                                </td>
                                <td>
                                    <img src="{{ asset('site/breeds/male' . $breed['type']. '.png') }}">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                {{$breed['desc']}}
                                </td>
                            </tr>
                        @endforeach

                </table>

            </div>

        </div><!--END OF PAGE DIV-->





<script>
    //ADD TRIGGER TO BUTTONS
document.querySelectorAll(".pony-button").forEach((button) => {
    button.addEventListener("click", () => {
        const type = button.dataset.type;
        loadPony(type);
        document.getElementById("content-area").classList.add("hidden");
        document.getElementById("gentitle").innerText = "Generator";
    });
});

</script>



