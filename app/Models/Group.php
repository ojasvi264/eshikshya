<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'eclasses_id',
        'sections_id',
    ];

    public function class()
    {
        return $this->belongsTo('App\Models\Eclass', 'eclasses_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'sections_id', 'id');
    }

    public function category_group()
    {
        return $this->hasMany(Category::class);
    }
}
