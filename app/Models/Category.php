<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_categories');
    }

    protected $casts = [
        'description_and_images' => 'array',
        'filterable_attributes' => 'array'
    ];
}
