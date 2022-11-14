<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const ROLES = array('user' => 1, 'author' => 2);

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
