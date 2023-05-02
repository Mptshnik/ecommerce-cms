<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function childCategories()
    {
        return $this->hasMany(Category::class);
    }

    public function getKeyValueFromDescription(string $key)
    {
        return data_get($this->description_and_images, $key);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_categories');
    }

    protected $casts = [
        'description_and_images' => 'array',
        'filterable_attributes' => 'array'
    ];
}
