<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $adminController = false;
    protected $viewPath = '';

    public function __construct() {
        if($this->adminController) {
            // Get Controller Class Name
            $class = get_class($this);

            $classNameWithNamespaceRemoved = substr($class, strlen('App\Http\Controllers\\'));

            $classNameWithControllerSuffixRemoved = substr($classNameWithNamespaceRemoved, 0, strpos($classNameWithNamespaceRemoved, 'Controller'));

            $folderNames = explode('\\', $classNameWithControllerSuffixRemoved);

            $viewPath = '';

            foreach ($folderNames as $folder) {
                $viewPath .= camel_case($folder) . '.';
            }

            $this->viewPath = $viewPath;
        }
    }

    protected function getView($viewName, $args) {
        return view($this->viewPath . $viewName, array_merge($args, ['viewPath' => $this->viewPath]));
    }
}
