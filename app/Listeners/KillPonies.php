<?php

namespace App\Listeners;

use App\Events\PonyReaper;
use App\Models\Pony;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class KillPonies
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
    public function handle(PonyReaper $event): void
    {
        //KILL PONIES THAT HAVE NO MORE HEALTH POINTS
        Pony::where('health', '<=', 0)
            ->where('isAlive', 1)
            ->update(['isAlive' => 0]);
    }
}
