<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\RoleFactory;
use Spatie\Permission\Models\Role as RoleUser;

class Role extends RoleUser
{
    use HasFactory;

    protected static function newFactory()
    {
        return RoleFactory::new();
    }
}
