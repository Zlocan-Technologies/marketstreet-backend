<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_order_id',
        'product_id',
        'quantity',
        'price',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $with = ['product'];

    public function subOrder()
    {
        return $this->belongsTo(SubOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->without('owner', 'reviews')->withTrashed();
    }
}
