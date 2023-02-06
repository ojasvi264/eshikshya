<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ItemStock extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['item_category_id', 'item_id', 'item_supplier_id', 'item_store_id', 'quantity', 'purchase_price', 'date', 'description'];


    public function getDocumentAttribute($value)
    {
        return $this->hasMedia() ? $this->getMedia()[0]->getFullUrl() : '';
    }

    public function item_category(){
        return $this->belongsTo(ItemCategory::class, 'item_category_id', 'id');
    }
    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
    public function item_supplier(){
        return $this->belongsTo(ItemSupplier::class, 'item_supplier_id', 'id');
    }
    public function item_store(){
        return $this->belongsTo(ItemStore::class, 'item_store_id', 'id');
    }
}
