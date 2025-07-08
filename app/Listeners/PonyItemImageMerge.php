<?php

namespace App\Listeners;

use App\Events\DressPony;
use App\Models\Item;
use App\Models\Pony;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PonyItemImageMerge
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
    public function handle(DressPony $event): void
    {
        //PULL ALL ITEMS FROM THE PONY
        $pony = Pony::where('ponyid', $event->pony[0]["ponyid"])->get();

        $type = $pony[0]["typeid"];
        $token = $pony[0]["token"];

        //GET BLANK PONY IMAGE
        $ponyImg = imagecreatefromstring($pony[0]["image"]);
        header('Content-Type: image/png');
        header('Cache-Control', 'max-age=2592000');
        imageAlphaBlending($ponyImg, true);
        imageSaveAlpha($ponyImg, true);

        $head = $pony[0]["Headware"];
        $face = $pony[0]["Faceware"];
        $neck = $pony[0]["Neckware"];
        $body = $pony[0]["Bodyware"];
        $tail = $pony[0]["Tailware"];
        $leg = $pony[0]["Legware"];
        $hoove = $pony[0]["Hooveware"];

        //MERGE THE IMAGES IN ORDER IF ITEM EQUIPPED
        if ($head) {
            $head = Item::where('itemid', $pony[0]["Headware"])->get();
            $headImg = imagecreatefromstring($head[0][$type]);
            header('Content-Type: image/png');
            header('Cache-Control', 'max-age=2592000');
            imageAlphaBlending($headImg, true);
            imageSaveAlpha($headImg, true);
            imagecopy($ponyImg, $headImg, 0, 0, 0, 0, 599, 485);
        }
        //MERGE THE IMAGES IN ORDER IF ITEM EQUIPPED
        if ($hoove) {
            $hoove = Item::where('itemid', $pony[0]["Hooveware"])->get();
            $hooveImg = imagecreatefromstring($hoove[0][$type]);
            header('Content-Type: image/png');
            header('Cache-Control', 'max-age=2592000');
            imageAlphaBlending($hooveImg, true);
            imageSaveAlpha($hooveImg, true);
            imagecopy($ponyImg, $hooveImg, 0, 0, 0, 0, 599, 485);
        }
        if ($leg) {
            $leg =  Item::where('itemid', $pony[0]["Legware"])->get();
            $legImg = imagecreatefromstring($leg[0][$type]);
            header('Content-Type: image/png');
            header('Cache-Control', 'max-age=2592000');
            imageAlphaBlending($legImg, true);
            imageSaveAlpha($legImg, true);
            imagecopy($ponyImg, $legImg, 0, 0, 0, 0, 599, 485);
        }
        if ($tail) {
            $tail = Item::where('itemid', $pony[0]["Tailware"])->get();
            $tailImg = imagecreatefromstring($tail[0][$type]);
            header('Content-Type: image/png');
            header('Cache-Control', 'max-age=2592000');
            imageAlphaBlending($tailImg, true);
            imageSaveAlpha($tailImg, true);
            imagecopy($ponyImg, $tailImg, 0, 0, 0, 0, 599, 485);
        }
        if ($body) {
            $body = Item::where('itemid', $pony[0]["Bodyware"])->get();
            $bodyImg = imagecreatefromstring($body[0][$type]);
            header('Content-Type: image/png');
            header('Cache-Control', 'max-age=2592000');
            imageAlphaBlending($bodyImg, true);
            imageSaveAlpha($bodyImg, true);
            imagecopy($ponyImg, $bodyImg, 0, 0, 0, 0, 599, 485);
        }
        if ($neck) {
            $neck = Item::where('itemid', $pony[0]["Neckware"])->get();
            $neckImg = imagecreatefromstring($neck[0][$type]);
            header('Content-Type: image/png');
            header('Cache-Control', 'max-age=2592000');
            imageAlphaBlending($neckImg, true);
            imageSaveAlpha($neckImg, true);
            imagecopy($ponyImg, $neckImg, 0, 0, 0, 0, 599, 485);
        }
        if ($face) {
            $face = Item::where('itemid', $pony[0]["Faceware"])->get();
            $faceImg = imagecreatefromstring($face[0][$type]);
            header('Content-Type: image/png');
            header('Cache-Control', 'max-age=2592000');
            imageAlphaBlending($faceImg, true);
            imageSaveAlpha($faceImg, true);
            imagecopy($ponyImg, $faceImg, 0, 0, 0, 0, 599, 485);
        }





        //WRITE THE IMAGE TO FILE FOR TEMPORARILY
        imagepng($ponyImg, $file = public_path('ponygen/test' . $token . '.png'));
        $mergedImg = file_get_contents(public_path('ponygen/test' . $token . '.png'));
        //DELETE TEMP FILE
        unlink(public_path('ponygen/test' . $token . '.png'));

        //UPDATE THE PONY WITH MERGED IMAGE
        Pony::where('ponyid', $event->pony[0]["ponyid"])
            ->update([
                'modified' => $mergedImg,
            ]);

        //CLEAN UP GD IMAGES
        imagedestroy($ponyImg);
    }
}
