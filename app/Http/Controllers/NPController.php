<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\AcquireItem;
use App\Events\TransferGold;

class NPController extends Controller
{
    //
    public function goBakery(Request $request) {
        $items = Item::where('npc', "whisk")
            ->select('itemid','itemname','itemtype', 'price','resell','stock','subtype','buff','debuff','rarity','info','tags')
            ->get();

        return view('shops.bakery',compact('items'));
    }

    public function goButcher(){
                $items = Item::where('npc', "butcher")
            ->select('itemid','itemname','itemtype', 'price','resell','stock','subtype','buff','debuff','rarity','info','tags')
            ->get();
        return view('shops.butcher',compact('items'));
    }

    public function explore(Request $request){
        return view('explore.world');
    }

    public function buyItem($item, $price , $user){

        $userWallet = Auth::user()->ponygold;
        $purchase = Item::where("itemid", $item)->get();
        //VERIFY USER CAN AFFORD
        if($userWallet < $price){
            return redirect()->back()->with('error', "Insufficient funds " .$purchase[0]["itemname"]." not purchased.");
        }
        //VERIFY ITEM HAS STOCK
        if($purchase[0]["stock"] < 1 ){
            return redirect()->back()->with('error', $purchase[0]["itemname"]." is sold out.");
        }
        
        //TRANSFER EVENT WHERE ENDPOINT NEEDS TO BE {game, npc, user}
        event(new AcquireItem($item, $user, 1));
        event(new TransferGold($user,$price,"game"));
        return redirect()->back()->with('success', "Successfully purchased ".$purchase[0]["itemname"] );

    }//END OF BUY ITEM

    
}
