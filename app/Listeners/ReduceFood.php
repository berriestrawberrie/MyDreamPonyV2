<?php

namespace App\Listeners;

use App\Events\PonyHungry;
use App\Models\Pony;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReduceFood
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
    public function handle(PonyHungry $event): void
    {
        //REDUCE PONY HUNGER STAT BY 5PTS. 
        $fed_ponies = Pony::where('hunger', '>', 0)->get();

        foreach ($fed_ponies as $pony) {

            Pony::where('ponyid', $pony->ponyid)
                ->update(['hunger' => $pony->hunger - 5]);
        }

        //IF PONY HAS NO HUNGER STAT THEN REDUCE HP STAT.
        $dying_ponies = Pony::where('hunger', '<=', 0)->get();

        foreach ($dying_ponies as $pony) {
            Pony::where('ponyid', $pony->ponyid)
                ->update(['health' =>  $pony->health - 5]);
        }
    }
}
