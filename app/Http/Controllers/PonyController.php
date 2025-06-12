<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PonyController extends Controller
{
    //
    public function ponyProfile($colors)
    {
        $hexcolors = json_decode($colors);
        return view('pony.ponyprofile', compact('hexcolors'));
    }
}
