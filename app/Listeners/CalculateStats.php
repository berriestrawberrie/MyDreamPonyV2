<?php

namespace App\Listeners;

use App\Events\CalculateGenetic;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Pony;

class CalculateStats
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
    public function handle(CalculateGenetic $event): void
    {
        //
        $stats = ["charm", "intel", "str", "hp", "level"];
        $babyStats = [];

        foreach($stats as $stat){
            $nxtStat = round(($event->ponys[0][$stat])+$event->ponys[1][$stat]/2);
            $babyStats[] = $nxtStat; // shorthand for array_push
        }


        Pony::where("token", $event->token)
            ->update([
                'charm' => $babyStats[0],
                'intel' => $babyStats[1],
                'str' => $babyStats[2],
                'hp' => $babyStats[3],
                'level' => $babyStats[4],
                'exp' => 0,
                'hunger' => 100,
                'health' => 100,
                
            ]);
    }
}
