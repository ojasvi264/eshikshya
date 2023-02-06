<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'purpose_id',
        'visitor_name',
        'phone',
        'id_card',
        'no_of_person',
        'visitor_date',
        'in_time',
        'out_time',
        'note',
        'file'
    ];
    public function purpose()
    {
        return $this->belongsTo('App\Models\Purpose', 'purpose_id', 'id');
    }
}
