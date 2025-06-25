<?php

namespace App\Http\Controllers;

use App\Events\AcquireItem;
use App\Events\DressPony;
use App\Events\RemoveItem;
use App\Models\Item;
use App\Models\Pony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        //EVENT REMOVE ITEM FROM USER
        event(new RemoveItem($itemID, Auth::user()->id, 1));

        return redirect(route('pony.profile', ['ponyid' => $ponyID]))->with('success', 'Pony fed');
    } //END OF FEED PET FUNCTION

    public function dressPony(Request $request)
    {
        if (!$request->input('petdress')) {
            return back()->with('error', 'Must select an item to equip');
        }
        $ponyID = $request->input('ponyID');
        $itemID = $request->input('petdress');

        $item = Item::where('itemid', $itemID)->get();
        $pony = Pony::where('ponyid', $ponyID)->get();

        //CHECK IF PONY ALREADY WEARING THE ITEM
        if (intval($itemID) === $pony[0][$item[0]["itemtype"]]) {
            //PONY ALREADY WEARING ITEM NO ACTION NEEDED. 
            return back()->with('error', 'Pony already equipped with this item.');
        } else {

            //PASS PONY AND ITEM
            event(new DressPony($pony, $item));
            //REMOVE THE EQUIPPED ITEM FROM INVENTORY
            event(new RemoveItem($itemID, Auth::user()->id, 1));

            //CHECK IF THE PONY HAD ANY OTHER ITEM EQUIPPED BEFORE
            if ($pony[0][$item[0]["itemtype"]]) {
                //ADD IT BACK TO THE INVENTORY
                event(new AcquireItem($pony[0][$item[0]["itemtype"]], Auth::user()->id, 1));
            }
        } //END OF ELSE

        return redirect(route('pony.profile', ['ponyid' => $ponyID]))->with('success', 'Item equipped.');
    } //END OF DRESS PONY FUNCTION
}
