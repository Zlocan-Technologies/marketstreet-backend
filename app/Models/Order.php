<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $fillable = [
        'user_id',
        'total',
        'reference',
        'payment_status',
        'order_status',
        'payment_channel',
        'coupon_code'
    ];

    protected $hidden = [
        'created_at',
        //'updated_at',
    ];

    protected $with = ['contents'];
    
    protected function updatedAt(): Attribute
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
        return $this->belongsToMany(Product::class, 'order_contents');
    }

}
