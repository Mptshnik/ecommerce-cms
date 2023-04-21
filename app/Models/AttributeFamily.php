<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeFamily extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function groups()
    {
        return $this->belongsToMany(AttributeGroup::class, 'attribute_groups_families');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
