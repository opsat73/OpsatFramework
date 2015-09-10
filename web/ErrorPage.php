<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 07.09.2015
 * Time: 2:49
 */
$sl = \opsatFramework\utils\ServiceLocator::getInstance();
$resp = $sl->getService("response");
$error = $resp->getContent("error");
?>
<H1><%=$error%></H1>
<a href="index.php">go to Home page</a>
