<?php

namespace App;

use App\Models\Api;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserApi;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
