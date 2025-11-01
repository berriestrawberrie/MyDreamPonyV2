<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class NPController extends Controller
{
    //
    public function goBakery(Request $request) {
        $items = Item::where('npc', "whisk")
            ->select('itemid','itemname','itemtype', 'price','resell','stock','subtype','buff','debuff','rarity','info','tags')
            ->get();

        return view('shops.bakery',compact('items'));
    }

    public function explore(Request $request){
        return view('explore.world');
    }
}
