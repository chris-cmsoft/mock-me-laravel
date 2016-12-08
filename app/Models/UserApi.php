<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserApi extends Model
{
    protected $fillable = [
        'user_id',
        'api_id',
        'api_key',
        'invite_sent_at',
        'accepted_invite'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function api() {
        return $this->belongsTo(Api::class);
    }

    public function access() {
        return $this->hasOne(UserApiAccess::class);
    }

    public function grantAllAccess() {
        $access = [];
        $possibleAccesses = UserApiAccess::getAllAccesses();
        foreach($possibleAccesses as $possibleAccess) {
            $access[$possibleAccess] = true;
        }
        $this->access()->create(array_merge($access,['user_id' => $this->user_id]));
    }

    public function createAccessRecord() {
        $access = [];
        $possibleAccesses = UserApiAccess::getAllAccesses();
        foreach($possibleAccesses as $possibleAccess) {
            $access[$possibleAccess] = false;
        }
        return $this->access()->create(array_merge($access,['user_id' => $this->user_id]));
    }
}
