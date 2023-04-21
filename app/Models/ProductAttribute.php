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
        return $this->belongsTo(AttributeType::class);
    }

    public function group()
    {
        return $this->belongsTo(AttributeGroup::class);
    }

    protected $casts = [
        'options' => 'array'
    ];
}
