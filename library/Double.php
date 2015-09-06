<?php

use Double\Stub;
use Double\StubbedException;

class Double {
    public static function stub($name, $methods = [])
    {
        return new Stub($name, $methods);
    }


    public static function throws($exception)
    {
        return new StubbedException($exception);
    }
}