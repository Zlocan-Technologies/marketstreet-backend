<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    use BelongsToUser;
    public $guarded = [];
}
