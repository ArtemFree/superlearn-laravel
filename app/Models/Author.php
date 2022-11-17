<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function responses() {
        return $this->hasMany(Response::class);
    }
}
