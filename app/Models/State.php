<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    //protected $primaryKey = 'name';

    protected $fillable = [
        'name',
        'lgas',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected function lgas(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }
}
