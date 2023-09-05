<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $guarded = false;

    public function order(){
        return $this->belongsTo(Order::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d.m.Y h:i',
        'updated_at' => 'datetime:d.m.Y h:i',
    ];
}
