<?php

namespace App\Jobs;

use App\Repository\VaccineRepo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ScheduleNotificationMasterJob implements ShouldQueue
{
    use Queueable;

    protected VaccineRepo $repo;

    /**
     * Create a new job instance.
     */
    public function __construct(VaccineRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->repo->sendScheduleNotification();
    }
}
