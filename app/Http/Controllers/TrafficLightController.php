<?php

namespace App\Http\Controllers;

use App\Models\TrafficLight;
use App\Services\SystemColorService;
use App\Services\SystemStatusService;
use Illuminate\Http\Request;

class TrafficLightController extends Controller
{
    // set traffic light status
    public function setStatus(Request $request)
    {
        $request->validate([
            'traffic_light_id'=> 'required|integer',
            'status' => 'required|string|in:on,off',
        ]);

        $trafficLight = TrafficLight::find($request->traffic_light_id);
        if (!$trafficLight) {

            // send notification to admin , microcontrollers  cant find traffic light, check microcontrollers
            return response()->json(['message' => 'Traffic light not found'], 404);
        }
        // set current status
        $trafficLight->status = $request->status;

        // set system status
        $systemStatusService = new SystemStatusService();
        $systemStatusService->setSystemStatusAfterTrafficLightStatusChange($trafficLight);

        $trafficLight->save();

        return response()->json(['message' => 'Traffic light status set'], 200);
    }


    // get traffic light system statuses
    public function getSystemStatuses($trafficLightId)
    {
        $trafficLight = TrafficLight::find($trafficLightId);
    }



    // setting light color
    public function setLightColor(Request $request)
    {
        $request->validate([
            'traffic_light_id' => 'required|integer',
            'color' => 'required|string|in:red,yellow,green',
        ]);
        $trafficLight = TrafficLight::find($request->traffic_light_id);
        if (!$trafficLight) {
            // send notification to admin , microcontrollers  cant find traffic light, check microcontrollers
            return response()->json(['message' => 'Traffic light not found'], 404);
        }

        $trafficLight->color = $request->color;
        // time limit for light color
        $systemColorService = new SystemColorService();
        $systemColorService->setSystemColorAfterTrafficLightColorChange($request, $trafficLight);
        $trafficLight->save();

        return response()->json(['message' => 'Traffic light light color set'], 200);
    }



    // car count
    public function carCount(Request $request)
    {
        $request->validate([
            'traffic_light_id' => 'required|integer',
            'count' => 'required|integer',
        ]);
        $trafficLight = TrafficLight::find($request->traffic_light_id);
        if (!$trafficLight) {
            return response()->json(['message' => 'Traffic light not found'], 404);
            }

        $trafficLight->current_car_count = $request->count;
        $trafficLight->save();

        return response()->json(['message' => 'Car count set'], 200);
    }
}
