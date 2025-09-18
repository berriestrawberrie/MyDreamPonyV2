<?php

namespace App\Listeners;

use App\Events\NewAdultPony;
use App\Models\BuildPony;
use App\Models\Pony;
use App\Models\SpecialTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ColorNMergeImages
{
    /**
     * Create the event listener.
     */
    public function __construct(NewAdultPony $event)
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
        $uncolored = ["hrainbow", "fvulpine","paint"];
        $breedID = $event->newPony[0]["breedID"];
        $babytrait = $event->newPony[0]["babytrait"];
        $traitID = $event->newPony[0]["traitID"];
        $coat = $event->newPony[0]["coat"];
        $hair = $event->newPony[0]["hair"];
        $hair2 = $event->newPony[0]["hair2"];
        $eye = $event->newPony[0]["eyes"];
        $accent = $event->newPony[0]["accent"];
        $accent2 = $event->newPony[0]["accent2"];

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

                    imagepng($gdImg, $file = public_path('ponygen/' . 'ponylistener' . 'specialtrait.png'));
                } else {
                    imagefilter($gdImg, IMG_FILTER_COLORIZE, $huer, $hueg, $hueb);
                    imagepng($gdImg, $file = public_path('ponygen/' . 'ponylistener' . 'specialtrait.png'));
                }
            } else {
                echo 'An error occured retrieving trait image from DB';
            }
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


        if ($babytrait) {
            //TRAIT IMAGE IS FACE OR BODY
            if (in_array($babytrait, $faces) || in_array($babytrait, $bodys)) {
                imagecopy($baseImg, $gdImg, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $hairImg, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $accentImg, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $accent2Img, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $maskImg, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $shadeImg, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $whiteImg, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $inkImg, 0, 0, 0, 0, 599, 485);
            }
            //TRAIT IMAGE IS HAIR
            if (in_array($babytrait, $hairs)) {
                imagecopy($baseImg, $hairImg, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $gdImg, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $accentImg, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $accent2Img, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $maskImg, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $shadeImg, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $whiteImg, 0, 0, 0, 0, 599, 485);
                imagecopy($baseImg, $inkImg, 0, 0, 0, 0, 599, 485);
            }
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

        //WRITE THE IMAGE TO FILE FOR TEMPORARILY
        imagepng($baseImg, $file = public_path('ponygen/test' . $token . '.png'));
        $mergedImg = file_get_contents(public_path('ponygen/test' . $token . '.png'));
        //DELETE TEMP FILE
        unlink(public_path('ponygen/test' . $token . '.png'));

        //UPDATE THE PONY WITH MERGED IMAGE
        Pony::where('token', $token)
            ->update([
                'image' => $mergedImg,
            ]);

        //CLEAN UP GD IMAGES
        imagedestroy($baseImg);
        imagedestroy($gdImg);
        imagedestroy($hairImg);
        imagedestroy($accentImg);
        imagedestroy($accent2Img);
        imagedestroy($whiteImg);
        imagedestroy($inkImg);
        imagedestroy($maskImg);
    }
}
