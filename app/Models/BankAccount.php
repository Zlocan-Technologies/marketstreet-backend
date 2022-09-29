<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $fillable = [
        'account_name',
        'account_number',
        'bank_name',
        'bank_code',
        'user_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function accountNumber(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Crypt::decryptString($value),
            set: fn ($value) => Crypt::encryptString($value),
        );
    }

    protected function accountName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Crypt::decryptString($value),
            set: fn ($value) => Crypt::encryptString($value),
        );
    }

}
