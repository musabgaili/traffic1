<?php

namespace App\Traits;

use App\Models\CarCount;
use App\Models\SystemColor;
use App\Models\SystemStatus;

trait TrafficLightCarCountTrait
{

    // get latest car count
    public function getLatestCarCount()
    {
        return $this->carCounts()->latest()->first();
    }

    // sum of car counts in the last 5 minutes
    public function getSumOfCarCountsInLast5Minutes()
    {
        return $this->carCounts()->where('created_at', '>=', now()->subMinutes(5))->sum('count');
    }

    // in last hour
    public function getSumOfCarCountsInLastHour()
    {
        return $this->carCounts()->where('created_at', '>=', now()->subHours(1))->sum('count');
    }

    // in last 24 hours
    public function getSumOfCarCountsInLast24Hours()
    {
        return $this->carCounts()->where('created_at', '>=', now()->subHours(24))->sum('count');
    }
}
