<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content_type',
        'available_for',
        'class_id',
        'section_id',
        'upload_date',
        'description',
        'content_file'
    ];

    public function class()
    {
        return $this->belongsTo('App\Models\Eclass', 'class_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
