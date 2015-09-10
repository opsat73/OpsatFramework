<?php
/**
 * Created by PhpStorm.
 * User: viko0313
 * Date: 29.08.2015
 * Time: 4:09
 */

namespace mindk;


use mindk\controller\handlers\CommonHandler;
use opsatFramework\core\Router;
use opsatFramework\errorHandler\ErrorHandlerManager;
use opsatFramework\utils\ServiceLocator;

class Application
{
    public function run()
    {
        error_reporting(0);
        $manager = new ErrorHandlerManager();
        $commonHandler = new CommonHandler();
        $manager->addErrorHandler($commonHandler, "commonErrorHandler");

        try {
            $serviceLocator = ServiceLocator::getInstance();
            $router = new Router(__DIR__ . "/../app/routing.ini", "students");
            $router->processRequest($serviceLocator->getService("request"));
        } catch (\Exception $e) {
            $manager->handleError($e);
        }

    }
}