<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public static int $ORDER_NOT_CONFIRMED = 0;
    public static int $ORDER_CONFIRMED = 1;
    public static int $ORDER_IN_PROCESSING = 2;
    public static int $ORDER_READY = 3;
    public static int $ORDER_CANCELLED = 4;
    public static int $ORDER_SHIPPED = 5;
    public static int $ORDER_TAKEN = 6;
    public static int $ORDER_IS_SHIPPING = 7;
    public static int $PAY_BY_CASH = 0;
    public static int $PAY_BY_CARD = 1;

    protected $guarded = false;

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }

    public function totalSum() : Attribute
    {
        $sum = 0;
        foreach ($this->products as $product)
        {
            $sum+=$product->getPriceForCount();
        }

        return Attribute::make(
            get: fn() => $sum
        );
    }

    protected $casts = [
        'confirmed_at' => 'datetime'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'orders_products')
            ->withPivot('product_count');
    }
}
