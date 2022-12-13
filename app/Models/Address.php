<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $fillable = [
        'order_id',
        'city',
        'state',
        'address'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
}
