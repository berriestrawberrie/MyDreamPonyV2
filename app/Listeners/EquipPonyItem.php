<?php

namespace App\Listeners;

use App\Events\DressPony;
use App\Models\Item;
use App\Models\Pony;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EquipPonyItem
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

        $item = $event->item[0]["itemid"];
        $type = $event->item[0]["itemtype"];

        //EQUIP THE ITEM TO THE PONY
        Pony::where('ponyid', $event->pony[0]["ponyid"])
            ->update([
                $type => $item
            ]);
    }
}
