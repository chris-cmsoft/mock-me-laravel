<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Api;

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
}
