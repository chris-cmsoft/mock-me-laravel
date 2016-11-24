<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Observers\ApiObserver;
use App\User;
use App\Models\Route;

class Api extends Model
{
    protected $fillable = [
        'name'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function routes() 
    {
        return $this->hasMany(Route::class);
    }

    public function getRouteKeyName()
    {
        return 'key';
    }
}
