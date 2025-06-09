<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SensorDevice;
use App\Models\Devices;

class SensorDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sensorDevice = SensorDevice::find($id);

        $validated = $request->validate([
            'temperature' => 'required',
            'humidity' => 'required',
            'status_relay' => 'required'
        ]);

        $sensorDevice->update([
            'temperature' => $validated['temperature'],
            'humidity' => $validated['humidity'],
            'status_relay' => $validated['status_relay'],
            'update' => now()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Sudah Diupdate',
            'data' => $sensorDevice
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
