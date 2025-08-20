<?php

namespace App\Http\Controllers;

use App\Events\NewBabyPony;
use App\Events\NewPony;
use App\Models\Pony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BreederController extends Controller
{
    //

    //PULL THE BREEDING OVERLAY FOR SUBMITTED PAIR
    public function preBreed(Request $request)
    {
        $breeders = [intval($request->input('breeder1')), intval($request->input('breeder2'))];
        $ponys = Pony::wherein('ponyid', $breeders)->get();

        //EVENT CALCULAT INBREEDING
        $start = date_create(date('Y-m-d H:m:s'));
        $birth = date_modify($start, "+5 days");


        return view('pony.components.breedingoverlay', compact('ponys', 'birth'));
    }

    public function breedPonies(Request $request, $type)
    {
        //GET THE PARENT COLORS
        $breeders = [intval($request->input('breeder1')), intval($request->input('breeder2'))];
        $ponys = Pony::wherein('ponyid', $breeders)->get();

        //GET BABY SEX
        $options = ["female", "male"];
        $sex = $options[array_rand($options)];

        $colors = ["eyeCol", "accentCol", "hairCol", "hairCol2", "baseCol", "accentCol2"];
        $stats = ["level", "intel", "str", "hp", "charm"];
        $babycolors = [];
        $babystats = [];


        //MIX COLORS BY BREEDING TYPE (RANGE OR AVERAGE)
        switch ($type) {
            case "average":
                for ($i = 0; $i < count($colors); $i++) {
                    //TAKE PONY1 COLOR CONVERT TO RGB
                    list($r1, $g1, $b1) = sscanf($ponys[0][$colors[$i]], "%02x%02x%02x");
                    //TAKE PONY2 COLOR CONVERT TO RGB
                    list($r2, $g2, $b2) = sscanf($ponys[1][$colors[$i]], "%02x%02x%02x");
                    //CALCULATE AVERAGES FOR NEW RGB
                    $nr = round((intval($r1) + intval($r2)) / 2);
                    $ng = round((intval($g1) + intval($g2)) / 2);
                    $nb = round((intval($b1) + intval($b2)) / 2);
                    $babycolors[$i] = sprintf("%02x%02x%02x", $nr, $ng, $nb);
                } //END COLOR GEN
                for ($i = 0; $i < count($stats); $i++) {
                    //TAKE PONY1 STAT
                    $stat1 = $ponys[0][$stats[$i]];
                    $stat2 = $ponys[1][$stats[$i]];
                    $babystats[$i] = round(($stat1 + $stat2) / 2);
                }
                break;
        }

        //DETERMINE THE BABY VISIBLE TRAITS
        if ($ponys[0]["specialtrait"] === $ponys[1]["specialtrait"]) {
            $babytrait = $ponys[0]["specialtrait"];
        } else {
            $babytrait = null;
        }

        //CACLUATE THE BREED BY PARENTS BREED 
        $types = [$ponys[0]["typeid"], $ponys[1]["typeid"]];
        $breedCalc = $types[array_rand($types)];


        //DETERMINE THE TRAIT # BY SEX AND BREED
        if ($breedCalc == 1) {
            $traitID = '"9"';
            $breedID = '9';
        } elseif ($breedCalc == 2) {
            $traitID = '"10"';
            $breedID = '10';
        } elseif ($breedCalc == 3) {
            $traitID = '"11"';
            $breedID = '11';
        } elseif ($breedCalc == 4) {
            $traitID = '"12"';
            $breedID = '12';
        } elseif ($breedCalc == 5) {
            $traitID = '"9"';
            $breedID = '9';
        } elseif ($breedCalc == 6) {
            $traitID = '"10"';
            $breedID = '10';
        } elseif ($breedCalc == 7) {
            $traitID = '"11"';
            $breedID = '11';
        } elseif ($breedCalc == 8) {
            $traitID = '"12"';
            $breedID = '12';
        }
        $colors = ["eyeCol", "accentCol", "hairCol", "hairCol2", "baseCol", "accentCol2"];
        $newPony = array([
            'eyes' => $colors[0],
            'token' => uniqid(),
            'hair' => $babycolors[2],
            'hair2' => $babycolors[3],
            'accent' => $babycolors[1],
            'accent2' => $babycolors[5],
            'specialtrait' => $babytrait,
            'coat' => $babycolors[4],
            'sex' => $sex,
            //BREED ID
            'breed' => $breedCalc,
            'breedID' => $breedID,
            'traitID' => $traitID,
            //LIST OF GENES
            'genes' => "",
            //SHOWN TRAIT NAME
            'babytrait' => $babytrait,
            'source' => "birth",
            'level' =>  $babystats[0],
            'intel' => $babystats[1],
            'str' => $babystats[2],
            'hp' => $babystats[3],
            'charm' => $babystats[4]
        ]);

        event(new NewPony($newPony));
        event(new NewBabyPony($newPony));

        // $colorsJson = json_encode($finalcolors);
        return redirect(route('nursery', ['userID' => Auth::user()->id]))->with('success', 'A new ponys is born!');
    }
}
