<?php

use Double\StubbedException;

class StubbedExceptionTest extends PHPUnit_Framework_TestCase {
    public function testItThrowsItsException() {
        $exception = new \Exception('foobar');

        $stubbed_exception = new StubbedException($exception);

        try {
            $stubbed_exception->throwNow();
            $this->fail('Did not throw exception');
        } catch(\Exception $e) {
            $this->assertEquals($exception, $e);
        }
    }
}