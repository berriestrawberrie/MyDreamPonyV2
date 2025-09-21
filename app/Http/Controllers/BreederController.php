<?php

namespace App\Http\Controllers;

use App\Events\NewBabyPony;
use App\Events\NewPony;
use App\Models\Pony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



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

        //ORDER THE DAM AND SIRE
        if($ponys[0]["sex"] === "female"){
            $dam = $ponys[0];
            $sire = $ponys[1];
        }else{
            $dam = $ponys[1];
            $sire = $ponys[0];
        }
        //CALCULATE THE LINEAGE
        $damLine = explode(",",$dam["lineage"]);
        $sireLine = explode(",",$sire["lineage"]);
        if(count($damLine)<6){
            $missing = 6 - count($damLine);
            $zeros = array_fill(0, $missing, 0);
            $newDam = array_merge($damLine,$zeros);
            $newDamList = implode(",",$newDam);
        }else{
            $newDam = array_slice($damLine, 0, 6);
            $newDamList = implode(",",$newDam);
        }
        if(count($sireLine)<6){
            $missing = 6 - count($sireLine);
            $zeros = array_fill(0, $missing, 0);
            $newSire = array_merge($sireLine,$zeros);
            $newSireList = implode(",",$newSire);
        }else{
            $newSire = array_slice($sireLine, 0,6);
            $newSireList = implode(",",$newSire);
        }
        //dd($newDamList , $newSireList);

        $lineage = $dam["ponyid"]. ",". $sire["ponyid"]. ",".$newDamList . ",". $newSireList;
        //GET BABY SEX
        $options = ["female", "male"];
        $sex = $options[array_rand($options)];
        $token = uniqid();
        //ADD BABY TO DAM AND SIRE LIST
        if($sex === "female"){
           Pony::where('ponyid', $dam["ponyid"])
           ->update([
            'filly' => $dam["filly"] .",". $token,
           ]);
            Pony::where('ponyid', $sire["ponyid"])
           ->update([
            'filly' => $dam["sire"] .",". $token,
           ]);

        }else{
           Pony::where('ponyid', $dam["ponyid"])
           ->update([
            'colt' => $dam["colt"] .",". $token,
           ]);
            Pony::where('ponyid', $sire["ponyid"])
           ->update([
            'colt' => $dam["colt"] .",". $token,
           ]);

        }




        $colors = ["hairCol2","eyeCol", "accentCol", "hairCol",  "baseCol", "accentCol2"];
        $stats = ["level", "intel", "str", "hp", "charm"];
        $babycolors = [];
        $babycolorsRGB = [];
        $babystats = [];


        //MIX COLORS BY BREEDING TYPE (REGULAR BREEDING)
        switch ($type) {
            case "regular":
                for ($i = 0; $i < count($colors); $i++) {
                    //TAKE PONY1 COLOR CONVERT TO RGB
                    list($r1, $g1, $b1) = sscanf($ponys[0][$colors[$i]], "%02x%02x%02x");
                    //TAKE PONY2 COLOR CONVERT TO RGB
                    list($r2, $g2, $b2) = sscanf($ponys[1][$colors[$i]], "%02x%02x%02x");
                    //FIND MAX & MIN between sire and dam
                    $minR = min(intval($r1),intval($r2));
                    $minG = min(intval($g1),intval($g2));
                    $minB = min(intval($b1),intval($b2));
                    $maxR = max(intval($r1),intval($r2));
                    $maxG = max(intval($g1),intval($g2));
                    $maxB = max(intval($b1),intval($b2));
                    $diffR = abs(intval($r1)-intval($r2));
                    $diffG = abs(intval($g1)-intval($g2));
                    $diffB = abs(intval($b1)-intval($b2));
                    //CALCULATE RANDOM SHAKE
                    $shake = rand(0,100)/100;
                    //RANDOMIZE THE STARTING POINTS
                    if(rand(0,1)=== 1){
                        $startR = $minR;
                        $fnr = $startR + round($diffR * $shake);
                    }else{
                        $startR = $maxR;
                        $fnr = $startR - round($diffR * $shake);
                    }
                    if(rand(0,1)=== 1){
                        $startG = $minG;
                        $fng = $startG + round($diffG * $shake);
                    }else{
                        $startG = $maxG;
                        $fng = $startG - round($diffG * $shake);
                    }
                    if(rand(0,1)=== 1){
                        $startB = $minB;
                        $fnb = $startB + round($diffB * $shake);
                    }else{
                        $startB = $maxB;
                        $fnb = $startB - round($diffB * $shake);
                    }

                    
                    //SHAKE EACH RGB INDIVIDUALLY
                    $nr = $fnr + rand(-15,15);
                    $ng = $fng + rand(-15,15);
                    $nb = $fnb + rand(-15,15);
                    //dd($message, $startR, $startG, $startB, $shake, $fnr , $fng , $fnb, $nr, $ng, $nb);

                    //CHECK THE VALUES ARE WITHIN RANGE
                    if($nr > $maxR){
                        $nr =  $maxR;
                    }elseif($nr < $minR){
                        $nr = $minR;
                    }else{
                        $nr = $nr;
                    }    
                    if($ng > $maxG){
                        $ng = $maxG;
                    }elseif($ng < $minG){
                        $ng = $minG;
                    }else{
                        $ng = $ng;
                    }  
                    if($nb > $maxB){
                        $nb = $maxB;
                    }elseif($nb < $minB){
                        $nb = $minB;
                    }else{
                        $nb = $nb;
                    }  
                    $babycolors[$i] = sprintf("%02x%02x%02x", $nr, $ng, $nb);
                    $babycolorsRGB[$i] = sprintf('%03d', $nr) . " " . sprintf('%03d', $ng) . " " . sprintf('%03d', $nb) ;
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
        $colors = ["hairCol2","eyeCol", "accentCol", "hairCol",  "baseCol", "accentCol2"];
        $newPony = array([
            'eyes' => $babycolors[1],
            'token' => $token,
            'hair' => $babycolors[3],
            'hair2' => $babycolors[0],
            'accent' => $babycolors[2],
            'accent2' => $babycolors[5],
            'specialtrait' => $babytrait,
            'coat' => $babycolors[4],
            'eyesRGB' => $babycolorsRGB[1],
            'coatRGB' => $babycolorsRGB[4],
            'hairRGB' => $babycolorsRGB[3],
            'hair2RGB' => $babycolorsRGB[0],
            'accentRGB' => $babycolorsRGB[2],
            'accent2RGB' => $babycolorsRGB[5],
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
            'charm' => $babystats[4],
            'lineage' => $lineage,
        ]);

        event(new NewPony($newPony));
        event(new NewBabyPony($newPony));

        // $colorsJson = json_encode($finalcolors);
        return redirect(route('nursery', ['userID' => Auth::user()->id]))->with('success', 'A new ponys is born!');
    }
}
