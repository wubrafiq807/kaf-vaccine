<?php

namespace App\Repository\Impl;

use App\Enums\StatusEnum;
use App\Enums\UserRole;
use App\Jobs\SendScheduleNotificationJob;
use App\Jobs\UpdateScheduleJob;
use App\Models\User;
use App\Models\VaccineRegister;
use App\Repository\VaccineRepo;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class VaccineRepoImpl implements VaccineRepo
{


    /**
     * @inheritDoc
     */
    public function doRegistration(array $params): bool
    {
        DB::beginTransaction();
        try {

            $user = new User();
            $user->name = $params['name'];
            $user->email = $params['email'];
            $user->password = Hash::make(env("DEFAULT_PASSWORD", "123456"));
            $user->role = UserRole::Customer;
            $user->save();

            $register = new VaccineRegister();
            $register->user_id = $user->id;
            $register->center_id = $params['center_id'];
            $register->nid = $params['nid'];

            $register->save();
            DB::commit();

            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Vaccine registration failed', $exception->getTrace());

            return false;
        }


        return true;
    }

    /**
     * @inheritDoc
     */
    public function schedule(): void
    {
        $registeredList = VaccineRegister::where('scheduled_at', null)
            ->orderBy('created_at')
            ->get();

        //Schedule will start from day after registration
        $scheduleDay = Carbon::today()->addDays(1)->addHour(9); // start from 9 am

        foreach ($registeredList as $item) {
            $item = $this->manageSchedule($item, $scheduleDay);
            UpdateScheduleJob::dispatchSync($item->id, $item->scheduled_at);
        }
    }

    private function manageSchedule(VaccineRegister $register, Carbon $scheduleDay): VaccineRegister
    {
        $count = VaccineRegister::whereDate('scheduled_at', $scheduleDay->toDateString())->count();
        if ($register->center->limit_per_day > $count) {
            $register->scheduled_at = $scheduleDay;
        }
        if ($register->center->limit_per_day <= $count) {
            $scheduleDay = $scheduleDay->addDays(1);
            $this->manageSchedule($register, $scheduleDay);
        }
        return $register;
    }

    /**
     * @inheritDoc
     */
    public function sendScheduleNotification(): void
    {
        $today = today();
        $tomorrowScheduleList = VaccineRegister::whereDate('scheduled_at', $today->addDays(1)->toDateString())->get();
        foreach ($tomorrowScheduleList as $item) {
            SendScheduleNotificationJob::dispatchSync($item);
        }
    }

    /**
     * @inheritDoc
     */
    public function search(string $nid): array
    {

        $status = StatusEnum::NotRegistered;
        $reg = VaccineRegister::where('nid', $nid)
            ->first();
        if ($reg) {
            if ($reg->scheduled_at) {
                $scheduleDate = Carbon::make($reg->scheduled_at);
                $now = today();
                if ($now->greaterThan($scheduleDate)) {
                    $status = StatusEnum::Vaccinated;
                }
                if ($now->lessThan($scheduleDate)) {
                    $status = StatusEnum::Scheduled;
                }
            } else {
                $status = StatusEnum::NotSchedule;
            }
        }

        return [
            'status' => $status,
            'link' => $status == StatusEnum::NotRegistered ? url('vaccine/create') : '',
            'schedule_date' => $status == StatusEnum::Scheduled ? $scheduleDate->toDateTimeString() ?? '' : ''
        ];
    }
}
