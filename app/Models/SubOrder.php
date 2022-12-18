<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'order_id',
        'order_no',
        'total',
        'order_status',
    ];

    protected $hidden = [
        'updated_at',
    ];

    protected $with = ['contents'];
    
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->toFormattedDateString(),
            set: fn ($value) => $value,
        );
    }

    public function contents()
    {
        return $this->hasMany(OrderContent::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_contents')
            ->without('owner', 'reviews')
                ->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
