<?php
/**
 * Created by PhpStorm.
 * User: viko0313
 * Date: 20.08.2015
 * Time: 1:42
 */

namespace mindk\test;


class Test
{
    public static $invoke_count;

    public function initCount() {
        if ($this::$invoke_count == null)
            $this::$invoke_count = 0;
        $this::$invoke_count++;
        echo $this::$invoke_count;
    }
}