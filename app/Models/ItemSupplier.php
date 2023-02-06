<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSupplier extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'address', 'contact_person_name', 'contact_person_email', 'contact_person_phone', 'description'];

    public function item_stocks(){
        return $this->hasMany(ItemStock::class);
    }
}
