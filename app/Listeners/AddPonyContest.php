<?php

namespace App\Listeners;

use App\Events\ContestSignUp;
use App\Models\Contest;
use App\Models\Pony;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddPonyContest
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ContestSignUp $event): void
    {

        $contest = Contest::where('token', $event->token)->get();
        $max = intval($contest[0]["maxlimit"]);
        //MERGE THE ENTRIES INTO A SINGLE ARRAY
        $addBaby = $event->babylist;
        $addAdult = $event->adultlist;
        //HOW MANY SLOTS ARE AVAILABLE FOR EACH? 
        $baby = ['baby1', 'baby2', 'baby3', 'baby4'];
        $adult = ['unlimit1', 'unlimit2', 'unlimit3', 'unlimit4'];
        $babySlot = [];
        $adultSlot = [];
        $newSlotAd = [];
        $newSlotBb = [];

        if ($event->adultlist != null) {
            //CHECK HOW MANY SLOTS ARE AVAILABLE FOR THE ADULTS
            foreach ($adult as $item) {
                //EXPAND CONTESTANT STRING INTO ARRAY SUBTRACT ENTRIES FROM CONTEST LIMIT
                $openSlot = $max - count(array_filter(explode(",", $contest[0][$item])));
                //PUSH INTO THE SLOTS ARRAY
                array_push($adultSlot, $openSlot);
            }
            //ADD THE NEW PONIES TO THE OPEN SLOTS
            for ($i = 0; $i < count($adultSlot); $i++) {
                array_push($newSlotAd, implode(",", array_slice($addAdult, 0, $adultSlot[$i])));
                $addAdult = array_diff($addAdult, array_slice($addAdult, 0, $adultSlot[$i]));
            }
            //MERGE THE NEW LIST WITH CURRENT LIST
            $newadult1 = $contest[0]['unlimit1'] . "," . $newSlotAd[0];
            $newadult2  = $contest[0]['unlimit2'] . "," .  $newSlotAd[1];
            $newadult3  = $contest[0]['unlimit3'] . "," .  $newSlotAd[2];
            $newadult4  = $contest[0]['unlimit4'] . "," .  $newSlotAd[3];

            //UPDATE PONIES TO CONTEST GROUPS
            $unlimit1 = array_filter(explode(",", $newSlotAd[0]));
            $unlimit2 = array_filter(explode(",", $newSlotAd[1]));
            $unlimit3 = array_filter(explode(",", $newSlotAd[2]));
            $unlimit4 = array_filter(explode(",", $newSlotAd[3]));

            if (count($unlimit1) > 0) {
                Pony::wherein('ponyid', $unlimit1)
                    ->update([
                        'nxt_contest' => 1,
                        'contest' => $event->token,
                        'contest_group' => 1,
                    ]);
            }
            if (count($unlimit2) > 0) {
                Pony::wherein('ponyid', $unlimit2)
                    ->update([
                        'nxt_contest' => 1,
                        'contest' => $event->token,
                        'contest_group' => 2,
                    ]);
            }
            if (count($unlimit3) > 0) {
                Pony::wherein('ponyid', $unlimit3)
                    ->update([
                        'nxt_contest' => 1,
                        'contest' => $event->token,
                        'contest_group' => 3,
                    ]);
            }
            if (count($unlimit4) > 0) {
                Pony::wherein('ponyid', $unlimit4)
                    ->update([
                        'nxt_contest' => 1,
                        'contest' => $event->token,
                        'contest_group' => 4,
                    ]);
            }

            Contest::where('token', $event->token)
                ->update([
                    'unlimit1' => $newadult1,
                    'unlimit2' => $newadult2,
                    'unlimit3' => $newadult3,
                    'unlimit4' => $newadult4,
                ]);
        } //END OF ADULT IF

        if ($event->babylist != null) {
            //CHECK HOW MANY SLOTS ARE AVAILABLE FOR THE BABY CONTESTS
            foreach ($baby as $item) {
                //EXPAND CONTESTANT STRING INTO ARRAY SUBTRACT ENTRIES FROM CONTEST LIMIT
                $openSlot = $max - count(array_filter(explode(",", $contest[0][$item])));
                //PUSH INTO THE SLOTS ARRAY
                array_push($babySlot, $openSlot);
            }

            //ADD THE NEW PONIES TO THE OPEN SLOTS
            for ($i = 0; $i < count($babySlot); $i++) {
                array_push($newSlotBb, implode(",", array_slice($addBaby, 0, $babySlot[$i])));
                $addBaby = array_diff($addBaby, array_slice($addBaby, 0, $babySlot[$i]));
            }

            //MERGE THE NEW LIST WITH CURRENT LIST
            $newbaby1 = $contest[0]['baby1'] . "," . $newSlotBb[0];
            $newbaby2  = $contest[0]['baby2'] . "," .  $newSlotBb[1];
            $newbaby3  = $contest[0]['baby3'] . "," .  $newSlotBb[2];
            $newbaby4  = $contest[0]['baby4'] . "," .  $newSlotBb[3];

            $baby1 = array_filter(explode(",", $newSlotBb[0]));
            $baby2 = array_filter(explode(",", $newSlotBb[1]));
            $baby3 = array_filter(explode(",", $newSlotBb[2]));
            $baby4 = array_filter(explode(",", $newSlotBb[3]));


            if (count($baby1) > 0) {
                Pony::wherein('ponyid', $baby1)
                    ->update([
                        'nxt_contest' => 1,
                        'contest' => $event->token,
                        'contest_group' => 1,
                    ]);
            }
            if (count($baby2) > 0) {
                Pony::wherein('ponyid', $baby2)
                    ->update([
                        'nxt_contest' => 1,
                        'contest' => $event->token,
                        'contest_group' => 2,
                    ]);
            }
            if (count($baby3) > 0) {
                Pony::wherein('ponyid', $baby3)
                    ->update([
                        'nxt_contest' => 1,
                        'contest' => $event->token,
                        'contest_group' => 3,
                    ]);
            }
            if (count($baby4) > 0) {
                Pony::wherein('ponyid', $baby4)
                    ->update([
                        'nxt_contest' => 1,
                        'contest' => $event->token,
                        'contest_group' => 4,
                    ]);
            }

            Contest::where('token', $event->token)
                ->update([
                    'baby1' => $newbaby1,
                    'baby2' => $newbaby2,
                    'baby3' => $newbaby3,
                    'baby4' => $newbaby4,
                ]);
        }

        /*
        //GET ALL THE PONIES AND UPDATE THEIR STATUS
        Pony::wherein('ponyid', $mergeAll)
            ->update([
                'nxt_contest' => 1,
                'contest' => $event->token
            ]);*/
    } //END OF EVENT LISTENER
}
