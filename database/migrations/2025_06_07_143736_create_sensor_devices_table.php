<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sensor_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained(
             table: 'devices', 
             indexName: 'posts_device_id'
            );
            $table->float('temperature', 5, 2)->default(0);
            $table->float('humidity', 5, 2)->default(0);
            $table->boolean('status_relay')->default(false);
            $table->timestamp('update');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_devices');
    }
};
