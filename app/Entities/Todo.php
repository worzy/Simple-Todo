<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    var $fillable = ['name', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
