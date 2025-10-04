<?php

namespace App\Listeners;

use App\Events\NewAdultPony;
use App\Models\BuildPony;
use App\Models\Pony;
use App\Models\SpecialTrait;


class MakeAdultImage
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
    public function handle(NewAdultPony $event): void
    {
        //
        $colors = ["eyes", "hair", "hair2", "accent", "accent2", "coat"];
        //ALL CURRENTLY AVAILABLE TRAITS
        $token = $event->newPony[0]["token"];
        $hairs = ["streak", "hfade", "hrainbow"];
        $faces = ["blaze", "ffade", "fvulpine"];
        $none = ["none"];
        $bodys = ["paint"];
        $uncolored = ["hrainbow", "fvulpine"];
        $breedID = $event->newPony[0]["breedID"];
        $specialtrait = explode(",",$event->newPony[0]["specialtrait"]);
        $traitID = $event->newPony[0]["traitID"];
        $coat = $event->newPony[0]["coat"];
        $hair = $event->newPony[0]["hair"];
        $hair2 = $event->newPony[0]["hair2"];
        $eye = $event->newPony[0]["eyes"];
        $accent = $event->newPony[0]["accent"];
        $accent2 = $event->newPony[0]["accent2"];

        $hairTImg = null;
        $faceImg = null;
        $bodyImg = null;
        $legImg = null;

        $pony = BuildPony::where('id', $breedID)->get();

        //BUILD THE TRAIT IMAGE
        if ($specialtrait) {
            
            //PULL THE IMAGE FROM DB BY AVATAR ID
            $specialtrait = SpecialTrait::wherein('traitname', $specialtrait)->get();


            
            for($i = 0; $i < count($specialtrait); $i++){
                
                switch ($specialtrait[$i]["traittype"]) {
                    case "hair":
                        //GENERATE GD IMAGE FROM DB BLOB
                        $hairTImg = imagecreatefromstring($specialtrait[$i][$traitID]);
                        header('Content-Type: image/png');
                        header('Cache-Control', 'max-age=2592000');
                        imageAlphaBlending($hairTImg, true);
                        imageSaveAlpha($hairTImg, true);
                        if(in_array($specialtrait[$i]["traitname"], $uncolored)){
                            //TRAIT IMAGE IS NOT COLORED
                            imagepng($hairTImg, $file = public_path('ponygen/' . 'ponylistener' . 'specialtraith.png'));
                        }else{
                            //TRAIT IMAGE IS COLORED
                            list($huer, $hueg, $hueb) = sscanf($hair2, "%02x%02x%02x");
                            imagefilter($hairTImg, IMG_FILTER_COLORIZE, $huer, $hueg, $hueb);
                            imagepng($hairTImg, $file = public_path('ponygen/' . 'ponylistener' . 'specialtraith.png'));
                        }
                        break;
                    case "face":
                        $faceImg = imagecreatefromstring($specialtrait[$i][$traitID]); header('Content-Type: image/png');
                        header('Cache-Control', 'max-age=2592000');
                        imageAlphaBlending($faceImg, true);
                        imageSaveAlpha($faceImg, true);
                        if(in_array($specialtrait[$i]["traitname"], $uncolored)){
                            //TRAIT IMAGE IS NOT COLORED
                            imagepng($faceImg, $file = public_path('ponygen/' . 'ponylistener' . 'specialtraitf.png'));
                        }else{
                            //TRAIT IMAGE IS COLORED
                            list($huer, $hueg, $hueb) = sscanf($accent2, "%02x%02x%02x");
                            imagefilter($faceImg, IMG_FILTER_COLORIZE, $huer, $hueg, $hueb);
                            imagepng($faceImg, $file = public_path('ponygen/' . 'ponylistener' . 'specialtraithf.png'));
                        }
                        break;
                    case "body":
                        $bodyImg = imagecreatefromstring($specialtrait[$i][$traitID]);
                        header('Cache-Control', 'max-age=2592000');
                        imageAlphaBlending($bodyImg, true);
                        imageSaveAlpha($bodyImg, true);
                        if(in_array($specialtrait[$i]["traitname"], $uncolored)){
                            //TRAIT IMAGE IS NOT COLORED
                            imagepng($bodyImg, $file = public_path('ponygen/' . 'ponylistener' . 'specialtraitb.png'));
                        }else{
                            //TRAIT IMAGE IS COLORED
                            list($huer, $hueg, $hueb) = sscanf($accent2, "%02x%02x%02x");
                            imagefilter($bodyImg, IMG_FILTER_COLORIZE, $huer, $hueg, $hueb);
                            imagepng($bodyImg, $file = public_path('ponygen/' . 'ponylistener' . 'specialtraithb.png'));
                        }
                        break;
                    case "leg":
                        $legImg = imagecreatefromstring($specialtrait[$i][$traitID]);
                        header('Cache-Control', 'max-age=2592000');
                        imageAlphaBlending($legImg, true);
                        imageSaveAlpha($legImg, true);
                        if(in_array($specialtrait[$i]["traitname"], $uncolored)){
                            //TRAIT IMAGE IS NOT COLORED
                            imagepng($legImg, $file = public_path('ponygen/' . 'ponylistener' . 'specialleg.png'));
                        }else{
                            //TRAIT IMAGE IS COLORED
                            list($huer, $hueg, $hueb) = sscanf($accent2, "%02x%02x%02x");
                            imagefilter($legImg, IMG_FILTER_COLORIZE, $huer, $hueg, $hueb);
                            imagepng($legImg, $file = public_path('ponygen/' . 'ponylistener' . 'specialleg.png'));
                        }
                        break;
                };
                
            }//END OF FOR LOOP



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

        //GENERATE THE BASE PONY IMAGE 
        imagecopy($baseImg, $hairImg, 0, 0, 0, 0, 599, 485);
        imagecopy($baseImg, $accentImg, 0, 0, 0, 0, 599, 485);
        imagecopy($baseImg, $accent2Img, 0, 0, 0, 0, 599, 485);
        
        //ADD THE TRAITS CONDITIONALLY
        if(!is_null($hairTImg)){
            imagecopy($baseImg, $hairTImg, 0, 0, 0, 0, 599, 485);
            imagedestroy($hairTImg);
        }
        if(!is_null($bodyImg)){
            imagecopy($baseImg, $bodyImg, 0, 0, 0, 0, 599, 485);
            imagedestroy($bodyImg);
        }
        if(!is_null($faceImg)){
            imagecopy($baseImg, $faceImg, 0, 0, 0, 0, 599, 485);
            imagedestroy($faceImg);
        } 
        if(!is_null($legImg)){
            imagecopy($baseImg, $legImg, 0, 0, 0, 0, 599, 485);
            imagedestroy($legImg);
        }
        //FINISH THE PONY IMAGE
        imagecopy($baseImg, $maskImg, 0, 0, 0, 0, 599, 485);
        imagecopy($baseImg, $shadeImg, 0, 0, 0, 0, 599, 485);
        imagecopy($baseImg, $whiteImg, 0, 0, 0, 0, 599, 485);
        imagecopy($baseImg, $inkImg, 0, 0, 0, 0, 599, 485);
        //GET THE PONY ID
        $ponyID = Pony::where('token', $token)
            ->get();


        //WRITE THE IMAGE TO FILE FOR TEMPORARILY
        imagepng($baseImg, $file = public_path('ponys/adult/' . $ponyID[0]["ponyid"] . '.png'));
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
}