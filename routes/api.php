<?php

use App\Http\Controllers\Api\DevicesController;
use App\Http\Controllers\Api\SensorDeviceController;
use Illuminate\Support\Facades\Route;

Route::post('/devices/add', [DevicesController::class, 'store']);
Route::post('/devices/remove/{device_id}', [DevicesController::class, 'destroy']);
Route::post('/devices/update/{device_id}', [DevicesController::class, 'update']);
Route::get('/devices', [DevicesController::class, 'index']);
Route::get('/devices/{device_id}', [DevicesController::class, 'show']);

Route::patch('/sensor/{id}', [SensorDeviceController::class, 'update']);