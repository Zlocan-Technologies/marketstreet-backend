<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
