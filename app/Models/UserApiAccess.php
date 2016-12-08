<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserApiAccess extends Model
{
    protected $fillable = [
        'can_create_routes',
        'can_update_routes',
        'can_delete_routes',
        'can_invite_members'
    ];

    public function userApi() {
        return $this->belongsTo(UserApi::class);
    }

    public static function getAllAccesses() {
        return [
            'can_create_routes',
            'can_update_routes',
            'can_delete_routes',
            'can_invite_members'
        ];
    }
}
