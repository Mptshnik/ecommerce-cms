<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $table = 'attributes';

    public function attributeType()
    {
        return $this->belongsTo(AttributeType::class, 'attribute_type_value_fk');
    }

    public function group()
    {
        return $this->belongsTo(AttributeGroup::class, 'group_name_fk', 'name');
    }

    public $timestamps = false;

    protected $casts = [
        'options' => 'array'
    ];
}
