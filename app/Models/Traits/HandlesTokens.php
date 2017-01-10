<?php

namespace App\Models\Traits;


use Carbon\Carbon;

trait HandlesTokens
{
    static function findByToken(string $token)
    {
        return self::where('api_token', $token)->first();
    }

    public function generateApiToken()
    {
        self::where('id', $this->id)
            ->update([
                'api_token_expires' => $this->getExpireTime(),
                'api_token' => $this->getNewApiToken(),
            ]);
        return $this;
    }

    public function getApiToken()
    {
        return $this->api_token;
    }

    public function hasValidToken()
    {
        return $this->api_token_expires > Carbon::now();
    }

    public function revokeToken()
    {
        self::where('id', $this->id)
            ->update([
                'api_token_expires' => null,
                'api_token' => null,
            ]);
        return $this;
    }

    public function refreshApiToken()
    {
        $newExpiration = $this->getExpireTime();
        self::where('id', $this->id)
            ->update([
                'api_token_expires' => $newExpiration,
            ]);
    }

    protected function getNewApiToken()
    {
        $token = Carbon::now()->timestamp . uniqid();
        return sha1($token);
    }

    protected function getExpireTime()
    {
        return Carbon::now()->addHour();
    }
}