<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'section_id',
        'session_id'
    ];
    public function class()
    {
        return $this->belongsTo('App\Models\Eclass', 'class_id', 'id');
    }
    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id', 'id');
    }
    public function session()
    {
        return $this->belongsTo('App\Models\Session', 'session_id', 'id');
    }
}
