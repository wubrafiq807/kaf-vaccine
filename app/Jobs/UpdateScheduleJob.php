<?php

namespace App\Jobs;

use App\Models\VaccineRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateScheduleJob implements ShouldQueue
{
    use Queueable;

    protected int $id;
    protected string $date;

    /**
     * Create a new job instance.
     */
    public function __construct($id, $date)
    {
        $this->id = $id;
        $this->date = $date;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        VaccineRegister::find($this->id)
            ->update(['scheduled_at' => $this->date]);
    }
}
