<edit></edit>
<?php
/**
 * Created by PhpStorm.
 * User: viko0313
 * Date: 04.08.2015
 * Time: 22:40
 */
use opsatFramework\utils as utils;
use mindk\test as testNameSpace;

    //init Loader
    require_once "../opsatFramework/utils/Loader.php";

    $loader = utils\Loader::getInstance();
    $loader ->setDir(__DIR__."/../");

    $app= new \mindk\Application();
    $app->run();

?>