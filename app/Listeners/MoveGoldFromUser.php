<?php

namespace App\Listeners;

use App\Events\TransferGold;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class MoveGoldFromUser
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
    public function handle(TransferGold $event): void
    {
        //READ IN THE INFORMATION
        $user = $event->userID;
        $gold = (int) $event->amount;
        $endpoint = $event->endpoint;

        switch($endpoint){
            case "game":
               User::where('id', $user)->decrement('ponygold', $gold);
            break;
            case "user":
            break;
            case "npc": 
            break;
        }

    }
}
