
<!--CONTEST TYPES INPUTS-->
    <p>This contest will cost {{Auth::user()->arena_cost}}PG to run: </p>
    <div class="flex  justify-evenly items-center">
        <select class="border-2 rounded-2xl p-2 border-sky-400" id="selectcontest" onchange="displayContest()">
            <option value="none">Select Contest Adult </option>
            <option value="split">Adult Splits</option>
            <option value="unlimit">Adult Unlimited</option>
        </select>
        <button class="w-[180px]" id="btnBaby"><i class="fa-solid fa-plus"></i> Baby Contests</button>
    </div>
    <form class="flex flex-col gap-4 justify-evenly" method="POST" action="/scheduleContest" enctype="multipart/form-data">
        @csrf
        <!--CONTEST TYPE SELECTIONS-->
        <div class="flex justify-evenly">
            <fieldset class="bg-sky-100 p-4 rounded-2xl hidden" id="adultsplit">
                <legend>Adult Contest:</legend>
                <!--ADULT SPLITS-->
                <div>
                <input type="checkbox" id="adultsplits1" value="split1" name="adultsplits[]">
                <label for="adultsplits1">
                    Adults 0 - 250
                </label>
                </div>
                <div>
                <input type="checkbox" id="adultsplits2" value="split2" name="adultsplits[]">
                <label for="adultsplits2">
                    Adults 251 - 500
                </label>
                </div>
                <div>
                <input type="checkbox" id="adultsplits3" value="split3" name="adultsplits[]">
                <label for="adultsplits3">
                    Adults 501 - 750
                </label>
                </div>
                <div>
                <input type="checkbox" id="adultsplits4" value="split4" name="adultsplits[]">
                <label for="adultsplits4">
                    Adults 751 - 1000
                </label>
                </div>
                <div>
                <input type="checkbox" id="adultsplits5" value="" name="adultsplits[]">
                <label for="adultsplits5">
                    Select All
                </label>
                </div>
            </fieldset>

            <fieldset class="bg-sky-100 p-4 rounded-2xl hidden"  id="adultunlimited">
                <legend>Adult Contest:</legend>                    
                <!--ADULT UNLIMITED-->
                <div>
                <input type="checkbox" id="adultunlimit1" value="unlimit1" name="adultunlimit[]">
                <label for="adultunlimit1">
                    Adults Unlimited I
                </label>
                </div>
                <div>
                <input type="checkbox" id="adultunlimit2" value="unlimit2"  name="adultunlimit[]">
                <label for="adultunlimit2">
                    Adults Unlimited II
                </label>
                </div>
                <div>
                <input type="checkbox" id="adultunlimit3" value="unlimit3"  name="adultunlimit[]">
                <label for="adultunlimit3">
                    Adults Unlimited III
                </label>
                </div>
                <div>
                <input type="checkbox" id="adultunlimit4" value="unlimit4"  name="adultunlimit[]">
                <label for="adultunlimit4">
                    Adults Unlimited IV
                </label>
                </div>
                <div>
                <input type="checkbox" id="adultunlimit5" value=""  name="adultunlimit[]">
                <label for="adultunlimit5">
                    Select All
                </label>
                </div>
            </fieldset>

            <fieldset class="bg-sky-100  p-4 rounded-2xl hidden" id="babies">
                <legend>Baby Contest:</legend>
                <!--BABY SPLITS-->
                <div>
                <input type="checkbox" id="baby1" value="baby1" name="baby[]">
                <label for="baby1">
                    Baby Unlimited I
                </label>
                </div>
                <div>
                <input type="checkbox" id="baby2" value="baby2" name="baby[]">
                <label for="baby2">
                    Baby Unlimited II
                </label>
                </div>
                <div>
                <input type="checkbox" id="baby3" value="baby3" name="baby[]">
                <label for="baby3">
                    Baby Unlimited III
                </label>
                </div>
                <div>
                <input type="checkbox" id="baby4" value="baby4" name="baby[]">
                <label for="baby4">
                    Baby Unlimited IV
                </label>
                </div>
                <div>
                <input type="checkbox" id="baby5" value="" name="baby[]">
                <label for="baby5">
                    Select All
                </label>
                </div>
            </fieldset>
        </div>    
        <fieldset>
            <label for="title">Contest Title</label>
            <input class="border rounded-lg p-1" type="text" id="title" name="title" placeholder="required (max50)" maxlength="50" required>
            <label for="Contest Type">Contest Type:</label>
            <select id="contest_attribute" name="contest_attribute" required>
                <option value="beauty">Beauty(charm)</option>
                <option value="racing">Racing(speed)</option>
                <option value="mathlete">Mathlete(intell)</option>
                <option value="ponypull">Pony Pull(Strength)</option>
                <option value="competitive">Competitive(All)</option>
            </select>
        </fieldset>

        <fieldset>
            <legend>Contest Banner:</legend>
            <label for="banner">
                <i class="text-sky-400 text-2xl me-2 fa-solid fa-folder-open"></i></label>
                <input class="border rounded-lg border-sky-300" type="file" name="banner" id="banner" accept="image/png, image/gif, image/jpeg">
            <label for="fee"><img class="ms-2 w-[20px] inline-flex" src="{{asset('site/coiny.png')}}">Fee:</label>
            <select id="fee" name="fee" required>
                <option selected value="0">Free</option>
                <option value="10">5PG</option>
                <option value="20">10PG</option>
                <option value="30">15PG</option>

            </select>
        </fieldset>

        <fieldset class="flex">
            <label>Schedule Time:</label>
            <select name="time" id="time" required>
                @for($i=0; $i<25; $i++)
                <option value="{{$i}}">{{$i}}:00</option>
                @endfor
            </select>
        </fieldset>

        <fieldset class="flex justify-end">
            @if(Auth::user()->ponygold >= Auth::user()->arena_cost)
            <button type="submit"><img class="ms-2 w-[20px] inline-flex" src="{{asset('site/coiny.png')}}">Pay & Create Contest</button>
            @else
            <button class="disabled-btn" disabled>Required {{Auth::user()->arena_cost}}PG<img class="ms-2 w-[20px] inline-flex" src="{{asset('site/coiny.png')}}"></button>
            @endif
        </fieldset>
    </form>

    <script type="text/javascript" src="{{ asset('js/contest.js') }}">
    </script>
