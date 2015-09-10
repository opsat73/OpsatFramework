<?php
/**
 * Created by PhpStorm.
 * User: viko0313
 * Date: 04.08.2015
 * Time: 23:47
 */
namespace opsatFramework\utils;

class Loader
{
    private static $instance;
    private static $classPath;

    public static function  getInstance() {
        if (self::$instance === null) {
            self::$instance = new Loader();
            self::$instance->initialization();
        }
        return self::$instance;
    }

    public static function setDir($argClassPath) {
        self::$classPath = $argClassPath;
    }

    static function loadClassByJavaStyle($class){
        $class = str_replace('\\', '/', $class);
        require_once self::$classPath.$class.".php";
    }

    private function initialization() {
        spl_autoload_register('opsatFramework\\utils\\Loader::loadClassByJavaStyle');
    }
}