<?php

namespace App\Listeners;

use App\Events\DeleteContest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DropPonyContest
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
    public function handle(DeleteContest $event): void
    {
        //
    }
}
