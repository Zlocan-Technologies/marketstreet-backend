<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'seller_id',
        'category_id',
        'name',
        'brand',
        'stock',
        'price',
        'description',
        'sales',
        'shipping_cost',
        'is_negotiable',
        'is_active',
        'is_dropshipped',
        'old_price',
        'is_brand_new',
        'has_been_dropshipped'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'is_active',
        'category_id'
    ];

    protected $with = ['reviews', 'images', 'owner'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function subOrders()
    {
        return $this->belongsToMany(SubOrder::class, 'order_contents');
    }

    public function dropship()
    {
        return $this->hasOne(Dropship::class, 'dropship_product_id');
    }

}
