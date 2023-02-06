<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;
    protected $fillable = [
        'complainType_id',
        'source_id',
        'complain_by',
        'phone',
        'complain_date',
        'action_taken',
        'assigned',
        'description',
        'note',
        'file'
    ];

    public function complain()
    {
        return $this->belongsTo('App\Models\ComplainType', 'complainType_id', 'id');
    }
    public function source()
    {
        return $this->belongsTo('App\Models\Source', 'source_id', 'id');
    }
}
