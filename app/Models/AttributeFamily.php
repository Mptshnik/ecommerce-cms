<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeFamily extends Model
{
    use HasFactory;

    protected $guarded = false;

    public $timestamps = false;

    public function groups()
    {
        return $this->belongsToMany(AttributeGroup::class,
            'attribute_groups_families', 'attribute_family_id',
            'attribute_group_name_fk','id', 'name')
            ->orderByRaw("FIELD(name, 'Общее', 'Описание', 'Цена', 'Доставка')");
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
