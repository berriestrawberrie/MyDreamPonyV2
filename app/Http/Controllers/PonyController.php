<?php

namespace App\Http\Controllers;

use App\Events\NewAdultPony;
use App\Models\Pony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PonyController extends Controller
{
    //
    public function ponyTesting($colors)
    {
        $hexcolors = json_decode($colors);
        return view('pony.ponytester', compact('hexcolors'));
    }
    public function ponyProfile($ponyid)
    {

        $pony = Pony::where('ponyid', $ponyid)->get();
        $owned = false;
        $owned = Pony::where('ownerid', Auth::user()->id)
            ->where('sex', '!=', $pony[0]["sex"])
            ->get();
        $lineage = explode(",", $pony[0]["lineage"]);
        //RESET INDEX AFTER REMOVING NULLS
        $filly = array_values(array_filter(explode(",", $pony[0]["filly"])));
        $colt = array_values(array_filter(explode(",", $pony[0]["colt"])));
        $babies = Pony::wherein('token', array_merge($filly,$colt))
            ->get(['name','ponyid','token']);
       //dd($babies);
        $keys = ["sex", "name","id"];
        //dd($lineage);
        

        return view('pony.ponyprofile', compact('pony', 'owned', 'lineage','filly','colt','babies'));
    }
    public function agePony(Request $request)
    {

        $getPony = Pony::where('ponyid', $request->input('ponyid'))->get();

        //DETERMINE THE TRAIT # BY SEX AND BREED
        if ($getPony[0]["typeid"] == 12 && $getPony[0]["sex"] == "male") {
            $traitID = '"4"';
            $breedID = '4';
            $typeid = 4;
        } elseif ($getPony[0]["typeid"] == 12 && $getPony[0]["sex"] == "female") {
            $traitID = '"8"';
            $breedID = '8';
            $typeid = 8;
        } elseif ($getPony[0]["typeid"] == 9 && $getPony[0]["sex"] == "female") {
            $traitID = '"1"';
            $breedID = '1';
            $typeid = 1;
        } elseif ($getPony[0]["typeid"] == 9 && $getPony[0]["sex"] == "male") {
            $traitID = '"5"';
            $breedID = '5';
            $typeid = 5;
        } elseif ($getPony[0]["typeid"] == 10 && $getPony[0]["sex"] == "female") {
            $traitID = '"2"';
            $breedID = '2';
            $typeid = 2;
        } elseif ($getPony[0]["typeid"] == 10 && $getPony[0]["sex"] == "male") {
            $traitID = '"6"';
            $breedID = '6';
            $typeid = 6;
        } elseif ($getPony[0]["typeid"] == 11 && $getPony[0]["sex"] == "female") {
            $traitID = '"3"';
            $breedID = '3';
            $typeid = 3;
        } elseif ($getPony[0]["typeid"] == 11 && $getPony[0]["sex"] == "male") {
            $traitID = '"7"';
            $breedID = '7';
            $typeid = 7;
        }

        //ACTUALLY AGE UP THE PONY
        Pony::where('ponyid', $request->input('ponyid'))
            ->update([
                'age' => 14,
                'typeid' => $typeid,
            ]);

        $agedPony = array([
            'eyes' => $getPony[0]["eyeCol"],
            'token' => $getPony[0]["token"],
            'hair' => $getPony[0]["hairCol"],
            'hair2' => $getPony[0]["hairCol2"],
            'accent' => $getPony[0]["accentCol"],
            'accent2' => $getPony[0]["accentCol2"],
            'specialtrait' => $getPony[0]["specialtrait"],
            'coat' => $getPony[0]["baseCol"],
            'sex' => $getPony[0]["sex"],
            'breed' => $request->input("breed"),
            'breedID' => $breedID,
            'traitID' => $traitID,
            'typeid' => $typeid,
        ]);

        event(new NewAdultPony($agedPony));

        return redirect(route('pony.profile', ['ponyid' => $request->input('ponyid')]))->with('success', $getPony[0]["name"] . ' grew Up!');
    }
    public function nextPony($stable, $current)
    {
        $user = Auth::user();
        //GET THE PONY LIST AND STABLE ORDER
        $ponys = Pony::where('ownerid', $user["id"])
            ->where('stable_assign', $stable)
            ->orderby('stable_ord')->get();
        $ponylist = [];
        $stablelist = [];
        for ($i = 0; $i < count($ponys); $i++) {
            $stablelist[$i] = $ponys[$i]["stable_ord"];
            $ponylist[$i] = $ponys[$i]["ponyid"];
        }

        //FIND THE INDEX OF THE CURRENT PONY
        $find = array_search($current, $ponylist);
        //CHECK IF YOU ARE AT THE END OF THE STABLE ORDER THEN RESET
        if ($find == (count($ponylist) - 1)) {
            $next = 0;
        } else {
            $next = $find + 1;
        }

        $nextpony = $ponylist[$next];


        return $this->ponyProfile($nextpony);
    }
    public function previousPony($stable, $previous)
        {

            $user = Auth::user();
            //GET THE PONY LIST AND STABLE ORDER
            $ponys = Pony::where('ownerid', $user["id"])
                ->where('stable_assign', $stable)
                ->orderby('stable_ord')->get();
            $ponylist = [];
            $stablelist = [];
            for ($i = 0; $i < count($ponys); $i++) {
                $stablelist[$i] = $ponys[$i]["stable_ord"];
                $ponylist[$i] = $ponys[$i]["ponyid"];
            }

            //FIND THE INDEX OF THE CURRENT PONY
            $find = array_search($previous, $ponylist);
            //CHECK IF YOU ARE AT THE END OF THE STABLE ORDER THEN RESET
            if ($find == 0) {
                $next = count($ponylist) - 1;
            } else {
                $next = $find - 1;
            }

            $nextpony = $ponylist[$next];


            return $this->ponyProfile($nextpony);
        }
}
