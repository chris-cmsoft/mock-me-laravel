<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $fillable = [
        'name'
    ];

    public function apiUsers()
    {
        return $this->hasMany(UserApi::class);
    }

    public function apiUser()
    {
        return $this->hasOne(UserApi::class)->where('user_id', auth()->user()->id);
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
