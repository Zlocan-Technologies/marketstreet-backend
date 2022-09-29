<?php

namespace App\Models;

use App\Traits\BelongsToUser;
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
        'user_id'
    ];
    
}
