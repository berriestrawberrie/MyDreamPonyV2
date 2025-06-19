<?php

namespace App\Http\Controllers;

use App\Models\Pony;
use Illuminate\Http\Request;

class PonyController extends Controller
{
    //
    public function ponyTesting($colors)
    {
        $hexcolors = json_decode($colors);
        return view('pony.ponytester', compact('hexcolors'));
    }
    public function ponyProfile($ponyid)
    {

        $pony = Pony::where('ponyid', $ponyid)->get();

        return view('pony.ponyprofile', compact('pony'));
    }
}
