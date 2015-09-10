<?php
/**
 * Created by PhpStorm.
 * User: viko0313
 * Date: 29.08.2015
 * Time: 0:43
 */

namespace opsatFramework\utils;

class ServiceLocator
{

    private static $instance = null;

    public static function getInstance() {
        if (self::$instance == null)
            self::$instance = new self();
        return self::$instance;
    }

    private function __construct() {
        $this->register("request", "opsatFramework\\utils\\Request", true);
        $this->register("response", Response::getInstance(), false);
    }
    private $services = array();

    public function register($key, $service, $needConstruct) {
        $this->services[$key] = new Service($service, $needConstruct);
    }

    public function hasService($key) {
        return ($this->services[$key] != null);
    }

    public function getService($key) {
        return $this->services[$key]->getService();
    }
}

class Service {
    private $isObject = false;
    private $service = null;

    public function __construct($service, $needConstructor) {
        $this->isObject = !$needConstructor;
        $this->service = $service;
    }

    public function getService() {
        if ($this->isObject) {
            return $this->service;
        } else {
            $service = $this->service;
            return  new $service;
        }
    }
}