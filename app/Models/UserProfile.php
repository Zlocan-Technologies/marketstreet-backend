<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $fillable = [
        'user_id',
        'state',
        'address',
        
        'rating',
        'orders',
        'sales',
        'customers',
        'reviews'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'orders',
        'sales',
        'customers',
        'reviews',
        'customers_count',
    ];

    protected $appends = ['customers_count'];

    protected function customers(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }

    public function getCustomersCountAttribute()
    {
        if(is_null($this->customers)):
            return 0;
        else:
            return count($this->customers);
        endif;
    }
    
}
