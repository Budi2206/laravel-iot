<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devices;
use App\Models\SensorDevice;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Devices::all();
        $sensor = SensorDevice::all();
        // return view('dashboard.index', compact('devices', 'sensor'));
        return response()->json([
            'status' => true,
            'message' => 'Data Dapat Diterima',
            'data' => $devices
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_name' => 'required',
            'room' => 'required'
        ]);
        
        $device = Devices::create($validated);

        $sensorDevice = $device->sensor()->create([
        'device_id' => $device->id,
        'temperature' => 0,
        'humidity' => 0,
        'status_relay' => false,
        'update' => now()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Sudah Dibuat',
            'device' => $validated,
            'sensor' => $sensorDevice
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($device_id)
    {
        $device = Devices::find($device_id);
        $sensor = SensorDevice::find($device_id);
        return response()->json([
            'status' => true,
            'message' => 'Data Dapat Ditampilkan',
            'device' => $device,
            'sensor' => $sensor
        ],201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $device_id)
    {
        $validated = $request->validate([
            'device_name' => 'required',
            'room' => 'required'
        ]);
        $device = Devices::find($device_id);
        if(!$device) {
        return response()->json([
            'status' => false,
            'message' => 'Device not found'
        ], 404);
    }

    $device->update($validated);

    return response()->json([
        'status' => true,
        'message' => 'Data Sudah Diupdate',
        'data' => $device // Lebih baik return data yang sudah diupdate
    ], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($device_id)
    {
        $deleted = Devices::destroy($device_id);

        if($deleted) {
            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil Dihapus',
                'data' => ['id' => $device_id]
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Ditemukan'
            ], 404);
        }
    }
}
