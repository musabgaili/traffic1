<?php

namespace App\Traits;

use App\Models\CarCount;
use App\Models\SystemColor;
use App\Models\SystemStatus;

trait TrafficLightSystemStatusesTrait
{


    // longest system "OFF" status in past 24 hours
    public function getLongestSystemOffStatusInPast24Hours()
    {
        return $this->systemStatuses()->where('status', 'off')->where('created_at', '>=', now()->subHours(24))->max('duration');
    }

    // longest system "ON" status in past 24 hours
    public function getLongestSystemOnStatusInPast24Hours()
    {
        return $this->systemStatuses()->where('status', 'on')->where('created_at', '>=', now()->subHours(24))->max('duration');
    }



    // latest system status with duration
    public function getLatestSystemStatusWithDuration()
    {
        return $this->systemStatuses()->latest()->first();
    }
}
