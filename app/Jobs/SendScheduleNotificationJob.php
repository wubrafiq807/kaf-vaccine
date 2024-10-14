<?php

namespace App\Jobs;

use App\Mail\SendSchedulelNotification;
use App\Models\VaccineRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendScheduleNotificationJob implements ShouldQueue
{
    use Queueable;

    protected VaccineRegister $register;

    /**
     * Create a new job instance.
     */
    public function __construct(VaccineRegister $register)
    {
        $this->register = $register;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::debug('kaka_mail_to', [$this->register]);
        Mail::to($this->register->user->email)
            ->send(new SendSchedulelNotification($this->register));
    }
}
