<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 06.09.2015
 * Time: 10:07
 */

namespace opsatFramework\errorHandler;


interface IErrorHandler
{
    public function handleError(\Exception $e);
}