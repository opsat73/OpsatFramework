<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 06.09.2015
 * Time: 10:06
 */

namespace opsatFramework\errorHandler;


class ErrorHandlerManager
{
    private $errorHandlers = array();

    public function addErrorHandler($errorHandler, $key) {
        $inKey = $key;
        if ($key == null) {
            $inKey = count($this->$errorHandler);
        }

        if ($errorHandler instanceof IErrorHandler) {
            $this->errorHandlers[$inKey] = $errorHandler;
        } else {
            throw new Exception("it is not ErrorHandler module");
        }
    }

    public function removeErrorHandler($key) {
        unset($this->errorHandlers[$key]);
    }

    public function handleError(\Exception $e) {
        foreach ($this->errorHandlers as $handler) {
            $handler->handleError($e);
        }
    }


}