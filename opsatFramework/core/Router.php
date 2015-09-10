<?php

namespace opsatFramework\core;

use opsatFramework\utils\Request;

class Router
{
    private $address;
    private $defaultController;
    public function __construct($fileAddress, $defaultController) {
        $this->address = $fileAddress;
        $this->defaultController = $defaultController;
    }

    public function processRequest(Request $request) {
        $controller = $request->getParameter("controller");
        if ($controller == null) {
            $controller = "students";
            $action = "defaultAction";
        } else {
            $action = $request->getParameter("action");
        }
        $controllerClass = $this->getControllerClassFromMapping($controller);
        $controller = new $controllerClass;
        $controller->$action();
    }

    private function  getControllerClassFromMapping($controller) {
        $mapping = array();
        $file = fopen($this->address, "r");
        while (!feof($file)) {
            $line = fgetss($file);
            preg_match("/--.*/", $line, $matches);
            if (count($matches) == 0) {
                preg_match("/(.*)=>.*/", $line, $matches);
                $key = $matches[1];
                preg_match("/.*=>(.*)/", $line, $matches);
                $value = $matches[1];
                $mapping[$key] = $value;
            }
        }
        return $mapping[$controller];
    }
}