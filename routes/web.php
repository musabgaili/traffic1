<?php

use App\Http\Controllers\AdminTrafficLightController;
use App\Models\TrafficLight;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('traffic-light.index');
});


// index
Route::get('/traffic-light', [AdminTrafficLightController::class, 'index'])->name('traffic-light.index');
// admin traffic light details
Route::get('/traffic-light/details/{id}', [AdminTrafficLightController::class, 'details'])->name('traffic-light.details');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);


Route::get('/xx', function () {
    return TrafficLight::find(3)->lightColors()->latest()->first();
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| Main Routes:
| - / : Redirects to traffic light index page
| - /traffic-light : Shows overview of all traffic lights
| - /home : Dashboard home page
|
| Authentication:
| - Login routes enabled
| - Registration disabled for security
| - Protected by auth middleware
| - Default login:
|   Email: admin@admin.com
|   Password: password
|
| Note: All admin routes require authentication
*/




