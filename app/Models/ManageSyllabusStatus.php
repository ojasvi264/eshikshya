<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageSyllabusStatus extends Model
{
    use HasFactory;
    protected $fillable = ['topic_id', 'completion_date', 'status'];

    public function topic(){
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }
}
