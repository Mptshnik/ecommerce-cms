<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function attributeFamily()
    {
        return $this->belongsTo(AttributeFamily::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'products_categories');
    }

    protected $casts = [
      'specifications' => 'array'
    ];
}
