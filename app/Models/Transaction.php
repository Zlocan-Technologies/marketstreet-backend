<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id', 
        'type',
        'amount', 
        'reference', 
        'method', 
        'status',
        'verified'
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
    ];

    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value)
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value->toFormattedDateString()
        );
    }

    public function wallet(){
        return $this->belongsTo(Wallet::class);
    }

}
