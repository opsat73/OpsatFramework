<?php
/**
 * Created by PhpStorm.
 * User: viko0313
 * Date: 29.08.2015
 * Time: 4:03
 */

namespace mindk\view;


use opsatFramework\utils\ServiceLocator;

class Renderer
{

    private static function drawHead() {
        include (__DIR__."/../../web/body_head.html");
    }

    private static function drawStudentsTable() {
        include (__DIR__."/../../web/StudentsTable.php");
    }

    private static function drawFoot() {
        include (__DIR__."/../../web/body_foot.html");
    }

    private static function drawInputForm() {
        include (__DIR__."/../../web/InputForm.php");
    }

    private static function drawErrorPage() {
        include (__DIR__."/../../web/ErrorPage.php");
    }

    private static function renderSuccessPage() {
        Renderer::drawHead();
        Renderer::drawStudentsTable();
        Renderer::drawInputForm();
        Renderer::drawFoot();
    }

    public static function renderErrorPage() {
        Renderer::drawHead();
        Renderer::drawErrorPage();
        Renderer::drawFoot();
    }

    public static function renderPage() {
        $sl = ServiceLocator::getInstance();
        $resp = $sl->getService("response");
        $error = $resp->getContent("error");
        if ($error == null) {
            Renderer::renderSuccessPage();
        } else {
            Renderer::renderErrorPage();
        }
    }


}