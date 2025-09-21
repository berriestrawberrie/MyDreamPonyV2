<?php

namespace App\Http\Controllers;

use App\Events\ColorPonyImage;
use App\Events\NewBabyPony;
use App\Events\NewPony;
use App\Listeners\MakeBabyImage;
use App\Models\BuildPony;
use App\Models\SpecialTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $finalcolorsRGB = [];

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
            $finalcolorsRGB[$i] = sprintf('%03d', $newcolors[0]) . " ". sprintf('%03d', $newcolors[1] ) . " ". sprintf('%03d', $newcolors[2] );
            $newcolors = [];
        } //END OF FOR LOOP

        $eye = $finalcolors[0];
        $hair = $finalcolors[1];
        $hair2 = $finalcolors[2];
        $accent = $finalcolors[3];
        $accent2 = $finalcolors[4];
        $coat = $finalcolors[5];
        $eyeRGB = $finalcolorsRGB[0];
        $hairRGB = $finalcolorsRGB[1];
        $hair2RGB = $finalcolorsRGB[2];
        $accentRGB = $finalcolorsRGB[3];
        $accent2RGB = $finalcolorsRGB[4];
        $coatRGB = $finalcolorsRGB[5];


        //DETERMINE THE TRAIT # BY SEX AND BREED
        if ($request->input("breed") == "Unicorn" && $sex == "male") {
            $traitID = '"12"';
            $breedID = '12';
        } elseif ($request->input("breed") == "Unicorn" && $sex == "female") {
            $traitID = '"12"';
            $breedID = '12';
        } elseif ($request->input("breed") == "Dragon" && $sex == "female") {
            $traitID = '"9"';
            $breedID = '9';
        } elseif ($request->input("breed") == "Dragon" && $sex == "male") {
            $traitID = '"9"';
            $breedID = '9';
        } elseif ($request->input("breed") == "Avian" && $sex == "female") {
            $traitID = '"10"';
            $breedID = '10';
        } elseif ($request->input("breed") == "Avian" && $sex == "male") {
            $traitID = '"10"';
            $breedID = '10';
        } elseif ($request->input("breed") == "Kittling" && $sex == "female") {
            $traitID = '"11"';
            $breedID = '11';
        } elseif ($request->input("breed") == "Kittling" && $sex == "male") {
            $traitID = '"11"';
            $breedID = '11';
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
            'eyesRGB' => $eyeRGB,
            'hairRGB' => $hairRGB,
            'hair2RGB' => $hair2RGB,
            'accentRGB' => $accentRGB,
            'accent2RGB' => $accent2RGB,
            'coatRGB' => $coatRGB,
            'sex' => $sex,
            //BREED ID
            'breed' => $request->input("breed"),
            'breedID' => $breedID,
            'traitID' => $traitID,
            //LIST OF GENES
            'genes' => $carryID,
            //SHOWN TRAIT NAME
            'babytrait' => $babytrait,
            'lineage' => '0,0',
            'source' => "generator",
        ]);

        event(new NewPony($newPony));
        event(new NewBabyPony($newPony));

        // $colorsJson = json_encode($finalcolors);
        return redirect(route('nursery', ['userID' => Auth::user()->id]))->with('success', 'A new ponys is born!');
        // return redirect()->route('ponyTester', ['colors' => $colorsJson]);
    } //END OF GEN FUNCTION
}
