<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function families()
    {
        return $this->belongsToMany(AttributeFamily::class, 'attribute_groups_families');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class );
    }
}
