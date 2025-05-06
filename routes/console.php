<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('queue:work --queue=high,medium,low')
->everyMinute()
->withoutOverlapping();

Schedule::command('social:post-manager')
->everyMinute()
->withoutOverlapping();

Schedule::command('email:manager')
->everyMinute()
->withoutOverlapping();

Schedule::command('email:fetch-and-cache')
->hourly()
->withoutOverlapping();

Schedule::command('email:failed-mail-collection')
->dailyAt('11:00')
->withoutOverlapping();

Schedule::command('email:failed-mail-deactive')
->dailyAt('22:00')
->withoutOverlapping();

// Artisan::command('queue:work --stop-when-empty --queue=high,medium,low', function () {
//     $this->comment('Processing queue...');
// })->describe('Process the queue with specified priorities')->everyMinute();