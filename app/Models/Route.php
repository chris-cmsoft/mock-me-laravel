<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Api;
use App\Models\Response;

class Route extends Model
{
    protected $fillable = [
        'name',
        'url'
    ];

    public function api() 
    {
        return $this->belongsTo(Api::class);
    }

    public function responses() {
        return $this->hasMany(Response::class);
    }
}
