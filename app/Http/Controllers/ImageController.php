<?php

namespace App\Http\Controllers;

use App\Models\BuildPony;
use App\Models\Item;
use App\Models\Pony;
use App\Models\SpecialTrait;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function getGenIcon($type)
    {
        //get the trait image data by ponytype and sex
        $rendered_buffer = Buildpony::where('typeName', $type)->get();
        $img = $rendered_buffer[0]["icon"];

        return response($img)
            ->header('Content-Type', 'image/png')
            ->header('Cache-Control', 'max-age=2592000');
    }

    public function getTrait($type, $traitid)
    {
        //get the trait image data by ponytype and sex
        $rendered_buffer = SpecialTrait::where('traitid', $traitid)->get();
        $check = '"' . $type . '"';
        $img = $rendered_buffer[0][$check];

        return response($img)
            ->header('Content-Type', 'image/png')
            ->header('Cache-Control', 'max-age=2592000');
    }

    public function buildPony($ponyid, $layer)
    {
        //get the pony image by ponyid
        $rendered_buffer = BuildPony::where('id', $ponyid)->get();
        $img = $rendered_buffer[0][$layer];
        return response($img)
            ->header('Content-Type', 'image/png')
            ->header('Cache-Control', 'max-age=2592000');
    }

    public function getItem($itemID, $type)
    {

        //get image id data by image id
        $rendered_buffer = Item::where('itemid', $itemID)->get();
        $img = $rendered_buffer[0][$type];
        return response($img)
            ->header('Content-Type', 'image/png')
            ->header('Cache-Control', 'max-age=2592000');
    }
}
