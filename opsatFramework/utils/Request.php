<?php
/**
 * Created by PhpStorm.
 * User: viko0313
 * Date: 26.08.2015
 * Time: 2:08
 */

namespace opsatFramework\utils;

class Request
{
    private $method;
    private $params;
    private $url;

    public function  __construct()
    {
       // $this->url = $_SERVER["REQUEST_URI"];
       // $this->method = $_SERVER["REQUEST_METHOD"];
        $this->params = $_REQUEST;
    }
    public function getMethod() {
        return $this->method;
    }

    public function haveParams($parameter) {
        return array_key_exists($parameter, $this->params);
    }

    public function getParameter($parameter) {
        if ($this->haveParams($parameter)) {
            return $this->params[$parameter];
        }
    }

    public function getAllParameters() {
        return $this->params;
    }
}