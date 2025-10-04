<?php

namespace App\Listeners;

use App\Events\NewBabyPony;
use App\Models\BuildPony;
use App\Models\Pony;
use App\Models\SpecialTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MakeBabyImage
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
    public function handle(NewBabyPony $event): void
    {
        $token = $event->newPony[0]["token"];
        $baby = Pony::where('token', $token)->get();


        $colors = ["eyes", "hair", "hair2", "accent", "accent2", "coat"];
        //ALL CURRENTLY AVAILABLE TRAITS
        $token = $token;
        $hairs = ["streak", "hfade", "hrainbow"];
        $faces = ["blaze", "ffade", "fvulpine"];
        $none = ["none"];
        $bodys = ["paint","belly","underbelly"];
        $legs = ["stocking"];
        $uncolored = ["hrainbow", "fvulpine","paint","stocking"];
        $breedID = $event->newPony[0]["breedID"];
        //NEXT ISSUE THE SPECIAL TRAITS NEED TO COME FROM THE DATABASE. 
        $babytrait = explode(",", $baby[0]["specialtrait"]);
        $traitID = $event->newPony[0]["traitID"];
        $coat = $event->newPony[0]["coat"];
        $hair = $event->newPony[0]["hair"];
        $hair2 = $event->newPony[0]["hair2"];
        $eye = $event->newPony[0]["eyes"];
        $accent = $event->newPony[0]["accent"];
        $accent2 = $event->newPony[0]["accent2"];

        //SCRUB EMPTY LIST FOR BABIES WITH NO VISIBLE GENES
        $babytrait = array_filter($babytrait);
        //DECLARE EMPTY TRAITS ALL
        $hairTraitImg = null;
        $faceTraitImg = null;
        $bodyTraitImg = null;
        $legTraitImg = null;
        
        //BUILD THE TRAIT IMAGE
        if (!empty($babytrait)) {
            //PULL THE IMAGE FROM DB BY AVATAR ID
            $specialtrait = SpecialTrait::wherein('traitname', $babytrait)->get();
            for($i=0; $i< count($babytrait); $i++){
                $img = $specialtrait[$i][$traitID];
                //GENERATE GD IMAGE FROM DB BLOB
                $gdImg = imagecreatefromstring($img);
                if ($gdImg !== false) {
                    header('Content-Type: image/png');
                    header('Cache-Control', 'max-age=2592000');
                    imageAlphaBlending($gdImg, true);
                    imageSaveAlpha($gdImg, true);
                    //EXTRACT THE SPECIAL TRAIT COLORING FROM ACCENT IF FACE OR BODY OR LEGS
                    if (in_array($babytrait[$i], $faces) || in_array($babytrait[$i], $bodys)||in_array($babytrait[$i], $legs)) {
                        //IF SPECIAL TRAIT IS BOY OR FACE USE ACCENT2
                        list($huer, $hueg, $hueb) = sscanf($accent2, "%02x%02x%02x");
                    } else {
                        //ELSE IT'S HAIR TRAIT SO COLOR WITH HAIR2
                        list($huer, $hueg, $hueb) = sscanf($hair2, "%02x%02x%02x");
                    }
                    //RECOLOR THE PONY HAIR TRAIT IMAGE IF HAIR IS NOT RAINBOW
                    if (in_array($babytrait[$i], $uncolored)) {

                        imagepng($gdImg, $file = public_path('ponygen/' . 'ponylistener'.$i . 'specialtrait.png'));
                    } else {
                        imagefilter($gdImg, IMG_FILTER_COLORIZE, $huer, $hueg, $hueb);
                        imagepng($gdImg, $file = public_path('ponygen/' . 'ponylistener' .$i. 'specialtrait.png'));
                    }
                } else {
                    echo 'An error occured retrieving trait image from DB';
                }

                //ATTACH THE IMAGE TO THE CORRECT IMAGE
                switch($babytrait[$i]){
                    case "streak":
                    case "hrainbow":
                    case "hfade":
                    $hairTraitImg = $gdImg;
                    break;
                    case "blaze":
                    case "ffade":
                    case "fvulpine":
                    $faceTraitImg = $gdImg;
                    break;
                    case "paint":
                    case "underbelly":
                    case "belly":
                    $bodyTraitImg = $gdImg;
                    break;
                    case "stocking":
                    $legTraitImg = $gdImg;
                }
                
            }//END OF FOR LOOP

        } else {
            $babytrait = null;
        } //END OF TRAIT IMAGE 

        //BUILD PONY IMAGE
        $pony = BuildPony::where('id', $breedID)->get();
        $ponyimgs = ["imgbase", "imghair", "imgaccent", "imgaccent2", "imgeye", "imgmask", "imgwhite", "imgshade", "imgink"];
        $ycolors = [$coat, $hair, $accent, $accent2, $eye];

        //UNCOLORED WHITE IMAGE
        $img = $pony[0]["imgwhite"];
        $whiteImg = imagecreatefromstring($img);
        header('Content-Type: image/png');
        header('Cache-Control', 'max-age=2592000');
        imageAlphaBlending($whiteImg, true);
        imageSaveAlpha($whiteImg, true);

        //UNCOLORED INK IMAGE
        $img = $pony[0]["imgink"];
        $inkImg = imagecreatefromstring($img);
        header('Content-Type: image/png');
        header('Cache-Control', 'max-age=2592000');
        imageAlphaBlending($inkImg, true);
        imageSaveAlpha($inkImg, true);

        //UNCOLORED SHADE IMAGE
        $img = $pony[0]["imgshade"];
        $shadeImg = imagecreatefromstring($img);
        header('Content-Type: image/png');
        header('Cache-Control', 'max-age=2592000');
        imageAlphaBlending($shadeImg, true);
        imageSaveAlpha($shadeImg, true);

        //UNCOLORED MASK IMAGE
        $img = $pony[0]["imgmask"];
        $maskImg = imagecreatefromstring($img);
        header('Content-Type: image/png');
        header('Cache-Control', 'max-age=2592000');
        imageAlphaBlending($maskImg, true);
        imageSaveAlpha($maskImg, true);



        //COLORED BASE IMAGE
        $img = $pony[0]["imgbase"];
        $baseImg = imagecreatefromstring($img);
        header('Content-Type: image/png');
        header('Cache-Control', 'max-age=2592000');
        imageAlphaBlending($baseImg, true);
        imageSaveAlpha($baseImg, true);
        list($huer, $hueg, $hueb) = sscanf($coat, "%02x%02x%02x");
        imagefilter($baseImg, IMG_FILTER_COLORIZE, $huer, $hueg, $hueb);

        //COLORED HAIR IMAGE
        $img = $pony[0]["imghair"];
        $hairImg = imagecreatefromstring($img);
        header('Content-Type: image/png');
        header('Cache-Control', 'max-age=2592000');
        imageAlphaBlending($hairImg, true);
        imageSaveAlpha($hairImg, true);
        list($huer, $hueg, $hueb) = sscanf($hair, "%02x%02x%02x");
        imagefilter($hairImg, IMG_FILTER_COLORIZE, $huer, $hueg, $hueb);

        //COLORED ACCENT 1
        $img = $pony[0]["imgaccent"];
        $accentImg = imagecreatefromstring($img);
        header('Content-Type: image/png');
        header('Cache-Control', 'max-age=2592000');
        imageAlphaBlending($accentImg, true);
        imageSaveAlpha($accentImg, true);
        list($huer, $hueg, $hueb) = sscanf($accent, "%02x%02x%02x");
        imagefilter($accentImg, IMG_FILTER_COLORIZE, $huer, $hueg, $hueb);

        //COLORED ACCENT 2
        $img = $pony[0]["imgaccent2"];
        $accent2Img = imagecreatefromstring($img);
        header('Content-Type: image/png');
        header('Cache-Control', 'max-age=2592000');
        imageAlphaBlending($accent2Img, true);
        imageSaveAlpha($accent2Img, true);
        list($huer, $hueg, $hueb) = sscanf($accent2, "%02x%02x%02x");
        imagefilter($accent2Img, IMG_FILTER_COLORIZE, $huer, $hueg, $hueb);


        if (!empty($babytrait)) {
            imagecopy($baseImg, $hairImg, 0, 0, 0, 0, 599, 485);
            imagecopy($baseImg, $accentImg, 0, 0, 0, 0, 599, 485);
            imagecopy($baseImg, $accent2Img, 0, 0, 0, 0, 599, 485);

            if(!is_null($hairTraitImg)){
                imagecopy($baseImg, $hairTraitImg, 0, 0, 0, 0, 599, 485);
                imagedestroy($hairTraitImg);
            }
            if(!is_null($bodyTraitImg)){
                imagecopy($baseImg, $bodyTraitImg, 0, 0, 0, 0, 599, 485);
                imagedestroy($bodyTraitImg);
            }
            if(!is_null($faceTraitImg)){
                imagecopy($baseImg, $faceTraitImg, 0, 0, 0, 0, 599, 485);
                imagedestroy($bodyTraitImg);
            }
            if(!is_null($legTraitImg)){
                imagecopy($baseImg, $legTraitImg, 0, 0, 0, 0, 599, 485);
            }
            imagecopy($baseImg, $maskImg, 0, 0, 0, 0, 599, 485);
            imagecopy($baseImg, $shadeImg, 0, 0, 0, 0, 599, 485);
            imagecopy($baseImg, $whiteImg, 0, 0, 0, 0, 599, 485);
            imagecopy($baseImg, $inkImg, 0, 0, 0, 0, 599, 485);

        } else {
            //NO VISIBLE TRAIT SO EXCLUDE TRAIT IMAGE
            imagecopy($baseImg, $hairImg, 0, 0, 0, 0, 599, 485);
            imagecopy($baseImg, $accentImg, 0, 0, 0, 0, 599, 485);
            imagecopy($baseImg, $accent2Img, 0, 0, 0, 0, 599, 485);
            imagecopy($baseImg, $maskImg, 0, 0, 0, 0, 599, 485);
            imagecopy($baseImg, $shadeImg, 0, 0, 0, 0, 599, 485);
            imagecopy($baseImg, $whiteImg, 0, 0, 0, 0, 599, 485);
            imagecopy($baseImg, $inkImg, 0, 0, 0, 0, 599, 485);
        }
        //GET THE PONY ID
        $ponyID =    Pony::where('token', $token)
            ->get();

        //WRITE THE IMAGE TO FILE FOR TEMPORARILY
        imagepng($baseImg, $file = public_path('ponys/baby/' . $ponyID[0]["ponyid"] . '.png'));
        $filename = $ponyID[0]["ponyid"] . '.png';


        //UPDATE THE PONY WITH MERGED IMAGE
        Pony::where('token', $token)
            ->update([
                'image' => $filename,
            ]);

        //CLEAN UP GD IMAGES
        imagedestroy($baseImg);
        //imagedestroy($gdImg);
        imagedestroy($hairImg);
        imagedestroy($accentImg);
        imagedestroy($accent2Img);
        imagedestroy($whiteImg);
        imagedestroy($inkImg);
        imagedestroy($maskImg);

    }
}
