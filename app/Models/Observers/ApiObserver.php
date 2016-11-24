<?php

namespace App\Models\Observers;

use App\Models\Api;

class ApiObserver
{
    public function creating(Api $api) {
        $api->key = $this->getNewKey();

        return $api;
    }

    /**
     * Generates a random key to identify API's
     * 
     */
    private function getNewKey() {
        // Get the current milliseconds
        $currentTime = microtime( );

        // Get a unique ID 
        $uniqueId = uniqid( );

        // Concatenate these to make a single encodable string
        $decodedKey = $currentTime . $uniqueId;

        // encode with sha1 encoding
        $encodedKey = sha1( $decodedKey );

        // uppercase for consistency and estetically pleasing keys
        $key = strtoupper( $encodedKey );
        return $key;
    }
}
