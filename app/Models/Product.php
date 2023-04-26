<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function quantity() : Attribute
    {
        $qty = 0;

        foreach ($this->inventories as $inventory)
        {
            $qty += $inventory->pivot->quantity;
        }

        return Attribute::make(get:fn() => $qty);
    }

    public function getKeyValue(string $key)
    {
        return data_get($this->specifications, $key);
    }

    public function productType()
    {
        return 'Простой';
    }

    public function attributeFamily()
    {
        return $this->belongsTo(AttributeFamily::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'products_categories');
    }

    public function inventories()
    {
        return $this->belongsToMany(InventorySource::class, 'products_inventories')
            ->withPivot('quantity');
    }

    protected $casts = [
        'specifications' => 'array'
    ];
}
