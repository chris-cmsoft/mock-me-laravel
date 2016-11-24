<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Observers\ApiObserver;
use App\User;

class Api extends Model
{
    protected $fillable = [
        'name'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'key';
    }
}
