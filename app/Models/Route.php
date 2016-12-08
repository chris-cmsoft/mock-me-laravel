<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'name',
        'url',
        'request_method',
        'response_time',
        'response_code',
        'payload_type',
        'payload',
        'is_active'
    ];

    public function api()
    {
        return $this->belongsTo(Api::class);
    }
}
