<div class='w-full relative  bg-white md:w-3/4 md:shadow-lg md:rounded-4xl p-4 pt-[50px] md:mx-auto'>

            <div class='float absolute left-0 -top-[70px] md:-left-[70px] md:-top-[90px] '>
                <span class='page text-3xl md:text-5xl' id="page-title">
                    <!--THIS IS WHERE THE PAGES TITLE-->
                    Register🌈
                </span>
                <img class=" w-[150px] md:w-[200px] -mt-8 md:-mt-10" src="{{asset('site/cloud.png')}}">
            </div>

            <div class="border flex flex-col items-center sm:mx-auto sm:w-3/4 "><!--THIS IS WHERE STUFF GOES-->
                <img src="{{asset('site/placeholder.png')}}">
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

            </div><!--END OF THIS IS WHERE STUFF GOES-->

        </div><!--END OF PAGE DIV-->



