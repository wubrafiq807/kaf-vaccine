<?php

namespace App\Console\Commands;

use App\Jobs\ScheduleNotificationMasterJob;
use App\Repository\VaccineRepo;
use Illuminate\Console\Command;

class notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(VaccineRepo $vaccineRepo)
    {
        $job = new ScheduleNotificationMasterJob($vaccineRepo);
        $job->handle();
    }
}
