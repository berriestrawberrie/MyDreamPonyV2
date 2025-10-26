<div class='w-full relative  bg-white md:w-3/4 md:shadow-lg md:rounded-4xl p-4 pt-[50px] md:mx-auto'>

            <div class='float absolute left-0 -top-[70px] md:-left-[70px] md:-top-[90px] '>
                <span class='page text-3xl md:text-5xl' id="page-title">
                    <!--THIS IS WHERE THE PAGES TITLE-->
                    Welcome!
                </span>
                <img class=" w-[150px] md:w-[200px] -mt-8 md:-mt-10" src="{{asset('site/cloud.png')}}">
            </div>

            <div ><!--STUFF DIV-->
                @if(Auth::user())
                    <form id="logout-form" class="mx-auto w-fit rounded-lg border" action="{{route('logout')}}" method="POST">
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
                    <button onclick="loadPartial('/register')" >Register!</button>
                @endif

            </div><!--END OF STUFF DIV-->
        </div><!--END OF PAGE DIV-->

<script>
// ┌─────────────────────────────┐
// │ CATCH THE LOGOUT REDIRECT   │
// └─────────────────────────────┘

    document.getElementById("logout-form").addEventListener("submit", function (e) {
    e.preventDefault();

    fetch(this.action, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": this.querySelector('[name="_token"]').value,
            "X-Requested-With": "XMLHttpRequest",
            Accept: "application/json",
        },
    })
        .then((response) => {
            if (response.ok || response.status === 204) {
                // Redirect manually after successful logout
                window.location.href = "/";
            } else {
                return response.text().then((text) => {
                    console.error("Logout failed:", text);
                });
            }
        })
        .catch((error) => {
            console.error("Network error:", error);
        });
});

</script>



