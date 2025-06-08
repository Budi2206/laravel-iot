<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SensorDevice extends Model
{
    use HasFactory;
    protected $fillable =['device_id', 'temperature', 'humidity', 'status_relay',];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Devices::class);
    }
}
