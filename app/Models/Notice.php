<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'section_id',
        'title',
        'notice',
        'description',
    ];

    public function class()
    {
        return $this->belongsTo('App\Models\Eclass', 'class_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id', 'id');
    }
}
