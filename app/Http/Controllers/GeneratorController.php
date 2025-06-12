<?php

namespace App\Http\Controllers;

use App\Events\ColorPonyImage;
use App\Events\NewPony;
use App\Models\BuildPony;
use App\Models\SpecialTrait;
use Illuminate\Http\Request;

class GeneratorController extends Controller
{
    //
    public function selectBreed()
    {
        $ponys = BuildPony::all();


        return view('ponygen.selectbreed', compact('ponys'));
    }

    public function ponyGen($type)
    {
        $ponys = BuildPony::all();
        $traits = SpecialTrait::all();
        return view('ponygen.generator', compact('ponys', 'type', 'traits'));
    }

    public function generatePony(Request $request)
    {
        $colors = ["eyes", "hair", "hair2", "accent", "accent2", "coat"];
        $carryID = [];

        //GENERATE A TEMPORARY TOKEN TO ASSOCIATE PONY
        $token = uniqid();

        //RETRIEVE THE GENERATOR PONY SEX
        $sex = $request->input("sex");

        //DETERMINE THE BABY TRAITS OR TRAITS
        $carry = [];
        $trait1 = $request->input("specialtrait1");
        $trait2 = $request->input("specialtrait2");

        if ($trait1 === $trait2) {
            $babytrait = $trait1;
        } else {
            $carry = [$trait1, $trait2];
            $carryID = [];
            //DETERMINE THE CARRY CODES FOR CARRIED GENES
            foreach ($carry as $i) {
                $special = SpecialTrait::where('traitname', $i)->get();
                $specialId = $special[0]["carry"];
                array_push($carryID, $specialId);
            } //END FOREACH

            $babytrait = null;
        } //END ELSE

        $newcolors = [];
        $finalcolors = [];

        //DETERMINE THE BABY COLOR MIX RANDOMIZATION
        for ($i = 0; $i < count($colors); $i++) {
            $hex = $request->input($colors[$i]);
            list($maxr1, $maxg1, $maxb1) = sscanf($hex, "#%02x%02x%02x");

            $colorMix = [$maxr1, $maxg1, $maxb1];
            foreach ($colorMix as $color) {
                //DETERMINE QUALITY OF THE ROLL
                $roll = rand(1, 10);
                if ($roll <= 2) {
                    //GOOD ROLLL
                    $shake = rand(-20, 20);
                    //GOES OVER 255
                    if ($color + $shake > 255) {
                        $new = $color - $shake;
                        array_push($newcolors, $new);
                        continue;
                    }
                    //GOES BELOW 0 
                    if ($color + $shake < 0) {
                        $new = $color - $shake;
                        array_push($newcolors, $new);
                        continue;
                    }
                    $new = $color + $shake;
                    array_push($newcolors, $new);
                    continue;
                } elseif ($roll <= 8) {
                    //AVERAGE ROLL
                    $shake = rand(-40, 40);
                    //GOES OVER 255
                    if ($color + $shake > 255) {
                        $new = $color - $shake;
                        array_push($newcolors, $new);
                        continue;
                    }
                    //GOES BELOW 0 
                    if ($color + $shake < 0) {
                        $new = $color - $shake;
                        array_push($newcolors, $new);
                        continue;
                    }
                    $new = $color + $shake;
                    array_push($newcolors, $new);
                    continue;
                } else {
                    //BAD ROLL
                    $shake = rand(-30, 30);
                    //GOES OVER 255
                    if ($color + $shake > 255) {
                        $new = $color - $shake;
                        array_push($newcolors, $new);
                        continue;
                    }
                    //GOES BELOW 0 
                    if ($color + $shake < 0) {
                        $new = $color - $shake;
                        array_push($newcolors, $new);
                        continue;
                    }
                    $new = $color + $shake;
                    array_push($newcolors, $new);
                    continue;
                }
            } //END OF FOREACH COLORMIX
            $babyhex = sprintf("%02x%02x%02x", $newcolors[0], $newcolors[1], $newcolors[2]);
            $finalcolors[$i] = $babyhex;
            $newcolors = [];
        } //END OF FOR LOOP

        $eye = $finalcolors[0];
        $hair = $finalcolors[1];
        $hair2 = $finalcolors[2];
        $accent = $finalcolors[3];
        $accent2 = $finalcolors[4];
        $coat = $finalcolors[5];


        //DETERMINE THE TRAIT # BY SEX AND BREED
        if ($request->input("breed") == "Unicorn" && $sex == "male") {
            $traitID = '"4"';
            $breedID = '4';
        } elseif ($request->input("breed") == "Unicorn" && $sex == "female") {
            $traitID = '"8"';
            $breedID = '8';
        } elseif ($request->input("breed") == "Dragon" && $sex == "female") {
            $traitID = '"1"';
            $breedID = '1';
        } elseif ($request->input("breed") == "Dragon" && $sex == "male") {
            $traitID = '"5"';
            $breedID = '5';
        } elseif ($request->input("breed") == "Avian" && $sex == "female") {
            $traitID = '"2"';
            $breedID = '2';
        } elseif ($request->input("breed") == "Avian" && $sex == "male") {
            $traitID = '"6"';
            $breedID = '6';
        } elseif ($request->input("breed") == "Kittling" && $sex == "female") {
            $traitID = '"3"';
            $breedID = '3';
        } elseif ($request->input("breed") == "Kittling" && $sex == "male") {
            $traitID = '"7"';
            $breedID = '7';
        }

        $newPony = array([
            'eyes' => $eye,
            'token' => $token,
            'hair' => $hair,
            'hair2' => $hair2,
            'accent' => $accent,
            'accent2' => $accent2,
            'specialtrait' => $babytrait,
            'coat' => $coat,
            'sex' => $sex,
            'breed' => $request->input("breed"),
            'breedID' => $breedID,
            'traitID' => $traitID,
            'genes' => $carryID,
            'babytrait' => $babytrait
        ]);

        event(new NewPony($newPony));
        event(new ColorPonyImage($newPony));

        return view('home')->with('success', 'A new ponys is born!');
        // return redirect()->route('ponyProfile', ['colors' => $colorsJson]);
    } //END OF GEN FUNCTION
}
