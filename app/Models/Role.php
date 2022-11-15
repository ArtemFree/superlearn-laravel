<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const ROLES = array('user' => 2, 'author' => 3, 'admin' => 1);

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
