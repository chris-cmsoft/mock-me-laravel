<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Route;

class Response extends Model
{
    protected $fillable = [
        'request_method',
        'response_time',
        'response_code',
        'payload_type',
        'payload',
        'is_active'
    ];

    public function route() {
        return $this->belongsTo(Route::class);
    }
}
