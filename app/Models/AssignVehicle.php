<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_id',
        'vehicle_id',
        'status'
    ];
    public function route()
    {
        return $this->belongsTo(VehicleRoute::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
