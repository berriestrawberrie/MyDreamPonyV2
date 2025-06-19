<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Pony;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function feedPet(Request $request)
    {
        if (!$request->input('foodfed')) {
            return back()->with('error', 'Must select a food to feed');
        }
        $ponyID = $request->input('ponyfed');
        $itemID = $request->input('foodfed');
        $qty = 1;

        $item = Item::where('itemid', $itemID)->get();
        $pony = Pony::where('ponyid', $ponyID)->get();
        $newHunger = $pony[0]["hunger"] + $item[0]["buff"];

        //IF PONY IS FULL DON'T CHANGE ANYTHING
        if ($newHunger > 100) {
            $newHunger = 100;
        } else {
            $newHunger = $newHunger;
        }
        Pony::where('ponyid', $ponyID)
            ->update(['hunger' => $newHunger]);

        return redirect(route('pony.profile', ['ponyid' => $ponyID]))->with('success', 'Pony fed');

        //EVENT REMOVE ITEM FROM USER



    } //END OF FEED PET FUNCTION
}
