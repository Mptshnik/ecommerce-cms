<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    protected $guarded = false;

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y h:i',
        'updated_at' => 'datetime:d.m.Y h:i',
    ];

    protected function phoneNumber(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Crypt::decryptString($value),
        );
    }

    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Crypt::decryptString($value),
        );
    }

    protected function lastName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Crypt::decryptString($value),
        );
    }

    protected function middleName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Crypt::decryptString($value),
        );
    }
}
