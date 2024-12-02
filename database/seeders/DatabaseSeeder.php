<?php

namespace Database\Seeders;

use App\Models\TrafficLight;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);

        /**
         * create 4 traffic lights
         * 3 with red color
         * 1 with green color
         * random serial number
         * random time limit
         * random current car count
         */

        for ($i = 1; $i <= 4; $i++) {
            $trafficLight = TrafficLight::create([
                'number' => $i,
                'serial_number' => 'SN-' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'current_car_count' => rand(0, 100),
                'color' => $i == 1 ? 'green' : 'red',
                'status' => $i == 1 ? 'on' : ($i == 2 ? 'off' : 'on'),
            ]);

            $trafficLight->systemStatuses()->create([
                'status' => $trafficLight->status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $trafficLight->lightColors()->create([
                'color' => $trafficLight->color,
                'updated_at' => now(),
                'time_limit' => rand(30, 120),
            ]);

            $trafficLight->save();
        }
    }
}
