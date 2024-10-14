<?php

namespace App\Repository;

interface VaccineRepo
{

    /**
     * Do registration process
     * @param array $params
     * @return bool
     */
    public function doRegistration(array $params): bool;


    /**
     * Do Schedule
     * @return void
     */
    public function schedule(): void;

    /**
     * Send Schedule notification to registered user
     * Notification will send each night at 9pm before schedule day
     * @return void
     */
    public function sendScheduleNotification(): void;

    /**
     * Search Result
     * @param string $nid
     * @return array
     */
    public function search(string $nid): array;
}
