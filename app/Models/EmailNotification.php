<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    use HasFactory;

    protected $primaryKey = 'email';

    protected $fillable = [
        'email',
        'is_subscribed',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}
