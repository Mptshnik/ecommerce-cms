<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttributeGroup extends Model
{
    use HasFactory;

    public static string $COMMON = 'Общее';
    public static string $DESCRIPTION = 'Описание';
    public static string $PRICE = 'Цена';
    public static string $SHIPPING = 'Доставка';
    protected $guarded = false;

    public function families()
    {
        return $this->belongsToMany(AttributeFamily::class, 'attribute_groups_families', 'attribute_group_name_fk', 'attribute_family_id');
    }

    public function attributes() : HasMany
    {
        return $this->hasMany(ProductAttribute::class, 'group_name_fk', 'name');
    }
}
