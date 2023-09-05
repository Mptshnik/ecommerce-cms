<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeFamily extends Model
{
    use HasFactory;

    protected $guarded = false;

    public $timestamps = false;

    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class,
            'attributes_families', 'attribute_family_id',
            'attribute_id','id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
