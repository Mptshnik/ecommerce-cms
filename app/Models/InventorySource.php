<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventorySource extends Model
{
    use HasFactory;
    protected $guarded = false;
    public $timestamps = false;

    public static string $DEFAULT = 'default';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_inventories')
            ->withPivot('quantity');
    }
    protected $casts = [
        'address' => 'array',
        'contact_information' => 'array'
    ];

}
