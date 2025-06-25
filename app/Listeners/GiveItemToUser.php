<?php

namespace App\Listeners;

use App\Events\AcquireItem;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GiveItemToUser
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
    public function handle(AcquireItem $event): void
    {
        //READ IN THE INFORMATION
        $user = $event->userID;
        $item = $event->itemID;
        $qty = $event->qty;

        $userItems = User::where('id', $user)->get();
        $itemArray = explode(",", $userItems[0]["itemid"]);
        $qtyArray = explode(",", $userItems[0]["qty"]);


        $index = array_search($item, $itemArray);

        //REMOVE FROM THE TO THE QTY 
        $qtyArray[$index] = $qtyArray[$index] + $qty;
        //RECOMBINE THE STRING
        $newQtyList = implode(",", $qtyArray);
        //UPDATE THE DB
        User::where('id', $user)
            ->update([
                'qty' => $newQtyList,
            ]);
    }
}
