<?php

namespace App\Models;

use App\Traits\TrafficLightCarCountTrait;
use App\Traits\TrafficLightSystemColorsTrait;
use App\Traits\TrafficLightSystemStatusesTrait;
use App\Traits\TrafficLightTrait;
use Illuminate\Database\Eloquent\Model;

class TrafficLight extends Model
{
    //

    protected $guarded = [];

    use TrafficLightSystemColorsTrait;
    use TrafficLightSystemStatusesTrait;
    use TrafficLightCarCountTrait;

    public function carCounts()
    {
        return $this->hasMany(CarCount::class);
    }


    // system statuses
    public function systemStatuses()
    {
        return $this->hasMany(SystemStatus::class);
    }

    // system colors
    public function lightColors()
    {
        return $this->hasMany(SystemColor::class);
    }
}
