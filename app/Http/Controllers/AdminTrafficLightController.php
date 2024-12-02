<?php

namespace App\Http\Controllers;

use App\Models\TrafficLight;
use Illuminate\Http\Request;

class AdminTrafficLightController extends Controller
{


    // auth construct
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        $trafficLights = TrafficLight::all();
        return view('admin.traffic-light.index', compact('trafficLights'));
    }

    function details(TrafficLight $trafficLight)
    {
        return view('admin.traffic-light.details', compact('trafficLight'));
    }
}
