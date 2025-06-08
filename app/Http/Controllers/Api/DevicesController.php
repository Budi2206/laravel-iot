<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Devices;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Devices::all();
        // return view('dashboard.index', compact('devices'));
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

        Devices::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Data Sudah Dibuat',
            'data' => $validated
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($device_id)
    {
        $device = Devices::find($device_id);
        return response()->json([
            'status' => true,
            'message' => 'Data Dapat Ditampilkan',
            'data' => $device
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
