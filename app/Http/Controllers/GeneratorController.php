<?php

namespace App\Http\Controllers;

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
        $babycolors = [];

        //ALL CURRENTLY AVAILABLE TRAITS
        $hairs = ["streak", "hfade", "hrainbow"];
        $faces = ["blaze", "ffade", "fvulpine"];
        $none = ["none"];
        $bodys = ["paint"];
        $uncolored = ["hrainbow", "fvulpine"];

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

            $babytrait = false;
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

        //BUILD THE TRAIT IMAGE
        if ($babytrait) {
            //PULL THE IMAGE FROM DB BY AVATAR ID
            $specialtrait = SpecialTrait::where('traitname', $babytrait)->get();
            $img = $specialtrait[0][$traitID];
            //GENERATE GD IMAGE FROM DB BLOB
            $gdImg = imagecreatefromstring($img);
            if ($gdImg !== false) {
                header('Content-Type: image/png');
                header('Cache-Control', 'max-age=2592000');
                imageAlphaBlending($gdImg, true);
                imageSaveAlpha($gdImg, true);
                //EXTRACT THE SPECIAL TRAIT COLORING FROM ACCENT IF FACE OR BODY
                if (in_array($babytrait, $faces) || in_array($babytrait, $bodys)) {
                    //IF SPECIAL TRAIT IS BOY OR FACE USE ACCENT2
                    list($huer, $hueg, $hueb) = sscanf($accent2, "%02x%02x%02x");
                } else {
                    //ELSE IT'S HAIR TRAIT SO COLOR WITH HAIR2
                    list($huer, $hueg, $hueb) = sscanf($hair2, "%02x%02x%02x");
                }
                //RECOLOR THE PONY HAIR TRAIT IMAGE IF HAIR IS NOT RAINBOW
                if (in_array($babytrait, $uncolored)) {

                    imagepng($gdImg, $file = public_path('ponygen/' . 'ponyimg-part' . 'specialtrait.png'));
                } else {
                    imagefilter($gdImg, IMG_FILTER_COLORIZE, $huer, $hueg, $hueb);
                    imagepng($gdImg, $file = public_path('ponygen/' . 'ponyimg-part' . 'specialtrait.png'));
                }
                $traitimg = $gdImg;
                imagedestroy($gdImg);
            } else {
                echo 'An error occurred.';
            }
        } else {
            $traitimg = false;
        } //END OF TRAIT IMAGE

        //BUILD PONY IMAGE
        $pony = BuildPony::where('id', $breedID)->get();
        $ponyimgs = ["imgbase", "imghair", "imgaccent", "imgaccent2", "imgeye", "imgmask", "imgwhite", "imgshade", "imgink"];
        $ycolors = [$coat, $hair, $accent, $accent2, $eye];

        for ($i = 0; $i < count($ponyimgs); $i++) {
            $img = $pony[0][$ponyimgs[$i]];
            //GENERATE GD IMAGE FROM DB BLOB
            $gdImg = imagecreatefromstring($img);
            header('Content-Type: image/png');
            header('Cache-Control', 'max-age=2592000');
            imageAlphaBlending($gdImg, true);
            imageSaveAlpha($gdImg, true);
            //COLORIZE ONLY THE COLOR LAYERS
            if ($i < 5) {
                //EXTRACT THE RGB FROM THE HEX COLOR
                list($huer, $hueg, $hueb) = sscanf($ycolors[$i], "%02x%02x%02x");
                imagefilter($gdImg, IMG_FILTER_COLORIZE, $huer, $hueg, $hueb);
                imagepng($gdImg, $file = public_path('ponygen/' . 'ponyimg-part' . $i . '.png'));
            }
            imagepng($gdImg, $file = public_path('ponygen/' . 'ponyimg-part' . $i . '.png'));
        }
        $colorsJson = json_encode($finalcolors);
        return redirect()->route('ponyProfile', ['colors' => $colorsJson]);
    } //END OF GEN FUNCTION
}
