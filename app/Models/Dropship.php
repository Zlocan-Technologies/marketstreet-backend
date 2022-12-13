<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropship extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_product_id',
        'dropship_product_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
