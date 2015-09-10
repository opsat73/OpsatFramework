<?php
/**
 * Created by PhpStorm.
 * User: viko0313
 * Date: 30.08.2015
 * Time: 1:45
 */

namespace opsatFramework\utils;


class Response
{
    private $content = array();

    private static $instance = null;

    public function addContent($key, $content, $contentType) {
        $this->content[$key] = new Content($content, $contentType);
    }

    public function getContent($key) {
        if ($this->content[$key] != null)
            return $this->content[$key]->getContent();
    }

    public function clear() {
        $this->content = array();
    }
    private function __construct(){}

    public static function getInstance() {
        if (self::$instance== null)
            self::$instance = new self();
        return self::$instance;
    }
}

class Content {
    private $contentType;
    private $content;

    public function __construct($content, $contentType) {
    $this->content = $content;
        $this->$contentType = $contentType;
    }

    public function getContent() {
        return $this->content;
    }

    public function getContentType() {
        return $this->contentType;
    }
}