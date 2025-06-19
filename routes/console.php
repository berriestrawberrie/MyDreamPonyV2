<?php

use App\Events\PonyHungry;
use App\Events\PonyReaper;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


//REDUCE FOOD AND KILL PONIES IF TOO HUNGRY
Schedule::call(function () {
    event(new PonyHungry());
    event(new PonyReaper());
})->daily();
