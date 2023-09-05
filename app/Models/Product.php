<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function rating() : Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->getRating(),
        );
    }

    private function getRating()
    {
        $reviews_count = $this->reviews()->count();
        if($reviews_count == 0)
        {
            return 0;
        }

        return $this->reviews()->sum('rating') / $reviews_count;
    }

    public function getPriceForCount()
    {
        return $this->specifications['price'] * $this->pivot->product_count;
    }

    public function itemsCount():Attribute
    {
        if(!is_null($this->pivot))
        {
            return Attribute::make(get: fn()=>$this->pivot->product_count);
        }

        return Attribute::make(get: fn()=>$this->quantity);
    }

    public function priceForCount(): Attribute
    {
        if(!is_null($this->pivot))
        {
            return Attribute::make(get: fn () => $this->specifications['price'] * $this->pivot->product_count);
        }

        return Attribute::make(get: fn () => 0);
    }

    public function orders(){
        return $this->belongsToMany(Product::class, 'orders_products')->withPivot('product_count');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function quantity() : Attribute
    {
        $qty = 0;

        foreach ($this->inventories as $inventory)
        {
            $qty += $inventory->pivot->quantity;
        }

        return Attribute::make(get:fn() => $qty);
    }

    public function getKeyValue(string $key)
    {
        return data_get($this->specifications, $key);
    }

    public function attributeFamily()
    {
        return $this->belongsTo(AttributeFamily::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'products_categories');
    }

    public function inventories()
    {
        return $this->belongsToMany(InventorySource::class, 'products_inventories')
            ->withPivot('quantity');
    }

    protected $casts = [
        'specifications' => 'array'
    ];
}
