<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Devices extends Model
{
    use HasFactory;
    protected $fillable = ['device_name', 'room'];

    public function sensor():HasOne
    {
        return $this->HasOne(SensorDevice::class, 'device_id') ;
    }
}
