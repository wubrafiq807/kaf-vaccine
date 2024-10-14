<?php

namespace App\Console\Commands;

use App\Jobs\ScheduleVaccineJob;
use App\Repository\VaccineRepo;
use Illuminate\Console\Command;

class ScheduleVaccine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:schedule-vaccine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle( VaccineRepo $vaccineRepo)
    {
       $job =  new ScheduleVaccineJob($vaccineRepo);
       $job->handle();
    }
}
