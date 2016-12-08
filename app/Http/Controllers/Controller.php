<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $viewPath = '';

    public function __construct() {
        $this->registerViewPath();
    }

    private function registerViewPath() {
        \View::addLocation(resource_path().'/views/' . ltrim($this->viewPath, '/') );
    }

    protected function generateNewKey() {
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
