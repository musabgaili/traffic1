<?php

namespace App\Traits;

use App\Models\CarCount;
use App\Models\SystemColor;
use App\Models\SystemStatus;

trait TrafficLightSystemColorsTrait
{

    // longest time limit in past hour
    public function getLongestTimeLimitInPastHour()
    {
        return $this->lightColors()->where('created_at', '>=', now()->subHours(1))->max('time_limit');
    }

    // shortest time limit in past hour
    public function getShortestTimeLimitInPastHour()
    {
        return $this->lightColors()->where('created_at', '>=', now()->subHours(1))->min('time_limit');
    }

    // average time limit in past hour
    public function getAverageTimeLimitInPastHour()
    {
        return $this->lightColors()->where('created_at', '>=', now()->subHours(1))->avg('time_limit');
    }

}
