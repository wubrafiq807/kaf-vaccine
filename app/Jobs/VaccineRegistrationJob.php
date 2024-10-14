<?php

namespace App\Jobs;

use App\Repository\VaccineRepo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VaccineRegistrationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $param;
    protected VaccineRepo $repo;

    /**
     * Create a new job instance.
     */
    public function __construct(array $param, VaccineRepo $repo)
    {
        $this->param = $param;
        $this->repo = $repo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->repo->doRegistration($this->param);
    }
}
