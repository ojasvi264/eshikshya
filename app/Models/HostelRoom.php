<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'hostel_id',
        'room_type_id',
        'number_of_bed',
        'cost_per_bed',
        'description',
        'status'
    ];


    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function room_type()
    {
        return $this->belongsTo(RoomType::class);
    }
}
