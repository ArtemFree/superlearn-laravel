<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function messages() {
        return $this->hasMany(ResponseMessage::class, 'response_id');
    }
}
