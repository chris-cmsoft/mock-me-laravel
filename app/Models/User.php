<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Traits\HandlesTokens;

class User extends Authenticatable
{
    use Notifiable, HandlesTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $dates = [
        'api_token_expires',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'api_token_expires',
    ];

    public function userApis()
    {
        return $this->hasMany(UserApi::class);
    }

    public function apis()
    {
        return $this->belongsToMany(Api::class, 'user_apis');
    }
}
