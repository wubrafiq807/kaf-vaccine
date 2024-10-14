<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:schedule-vaccine')->everyMinute(); // Its should be run hourly as for local env test I`m setting every minutes

/*
 * Send a notification email to the users at 9 PM before the night of their scheduled vaccination date .
 * Please note that command will run at 8.58 pm each day so that with 2 seconds mail notification  can end up
 * */
Schedule::command('app:notify')->dailyAt('20:58');

