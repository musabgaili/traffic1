<?php

use App\Http\Controllers\TrafficLightController;
use App\Http\Middleware\ApiTokenValidate;
use App\Models\TrafficLight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// all route protected by api token
Route::middleware(ApiTokenValidate::class)->group(function () {

// set traffic light status
Route::post('/traffic-light/status', [TrafficLightController::class, 'setStatus']);

// set traffic light color
Route::post('/traffic-light/color', [TrafficLightController::class, 'setLightColor']);

// set car count
Route::post('/traffic-light/car-count', [TrafficLightController::class, 'carCount']);


// get traffic light by ID
Route::get('/traffic-light/{id}', function (TrafficLight $trafficLight) {
    return response()->json($trafficLight);
});

// get all traffic lights
Route::get('/traffic-lights', function () {
    $trafficLights = TrafficLight::all();
    return response()->json($trafficLights);
});



});


/*
|--------------------------------------------------------------------------
| Traffic Light API Routes
|--------------------------------------------------------------------------
|
| POST /api/traffic-light/status
| Updates the operational status (on/off) of a specific traffic light
| Requires: traffic_light_id, status
| Used by: Microcontrollers to report status changes
|
| POST /api/traffic-light/color
| Sets the current color of a traffic light and its timing
| Requires: traffic_light_id, color, time_limit (optional)
| Used by: AI system to control light changes
|
| POST /api/traffic-light/car-count
| Updates the count of cars waiting at a traffic light
| Requires: traffic_light_id, count
| Used by: Sensors to report real-time traffic volume
|
| GET /api/traffic-light/{id}
| Retrieves details for a specific traffic light by ID
| Returns: Full traffic light object with current state
| Used by: Dashboard and monitoring systems
|
| GET /api/traffic-lights
| Lists all traffic lights in the system
| Returns: Array of all traffic light objects
| Used by: Admin dashboard for system overview
*/
