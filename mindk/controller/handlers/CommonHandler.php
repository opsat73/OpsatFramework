<?php

/**
 * Created by PhpStorm.
 * User: php
 * Date: 07.09.2015
 * Time: 2:26
 */
namespace mindk\controller\handlers;

use mindk\view\Renderer;

class CommonHandler implements \opsatFramework\errorHandler\IErrorHandler
{
    public function handleError(\Exception $e)
    {
        $sl = \opsatFramework\utils\ServiceLocator::getInstance();
        $responce = $sl->getService("response");
        $responce->addContent("error", "pizzzdec", "message");

        Renderer::renderPage();
    }
}