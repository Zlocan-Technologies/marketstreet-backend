<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'email',
        'phone',
        'note',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
