<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $fillable = ['user_id', 'set_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sets()
    {
        return $this->hasMany(Set::class, 'set_id');
    }
}
