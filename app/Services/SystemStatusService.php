<?php

namespace App\Services;

class SystemStatusService
{
    // setting new status will be done only if status is changed
    // otherwise update duration only
    public function setSystemStatusAfterTrafficLightStatusChange($trafficLight)
    {
        // get previous status
        $previousStatus = $trafficLight->systemStatuses()->latest()->first();
        // if previous status is same as new update duration only
        if ($previousStatus->status == $trafficLight->status) {
            $previousStatus->update([
                // old  duration + updated at time difference
                'duration' => $previousStatus->duration + now()->diffInSeconds($previousStatus->updated_at),
            ]);
        } else {
            // set new status
            $trafficLight->systemStatuses()->create([
                'status' => $trafficLight->status,
                // duration will be 0 because it is new status
                'duration' => 0,
            ]);
        }
    }

    /*
     * Duration Calculation Logic:
     *
     * When traffic light status changes:
     * 1. If the new status matches the previous status:
     *    - Takes the existing duration
     *    - Adds the time difference between now and last update
     *    - Formula: duration = previous_duration + (now - last_updated_time) in seconds
     *
     * 2. If status is different from previous:
     *    - Creates new status record
     *    - Sets initial duration to 0 seconds
     *    - Duration will be updated on next status change
     *
     * This allows tracking how long each status lasted continuously
     */
}
