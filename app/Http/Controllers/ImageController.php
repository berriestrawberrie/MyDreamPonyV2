<?php

namespace App\Http\Controllers;

use App\Models\BuildPony;
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
}
