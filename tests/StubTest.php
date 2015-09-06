<?php
use Double as d;
use Double\MethodNotFoundException;

class StubTest extends PHPUnit_Framework_TestCase {
    public function testItStubsAMethodWithAParameter() {
        $method = 'foo';
        $return_value = 'bar';
        $stub = d::stub('OneMethodStub', [$method => $return_value]);

        $this->assertEquals($return_value, $stub->$method());
    }

    public function testItThrowsAnExceptionIfMethodIsNotDefined() {
        $stub_name = 'NoMethodStub';
        $missing_method_name = 'foobar';
        $stub = d::stub($stub_name);

        try {
            $stub->$missing_method_name();
            $this->fail('Calling an undefined method did not throw an exception');
        } catch(MethodNotFoundException $e) {
            $this->assertEquals("${stub_name}::${missing_method_name} missing", $e->getMessage());
        }
    }

    public function testItStunsAMethodWithAnException() {
        $method = 'foobar';
        $exception = new \Exception('Foobar');
        $stub = d::stub('ErrorStub', [$method => d::throws($exception)]);

        try {
            $stub->$method();
            $this->fail('The failing method did not throw the stubed exception');
        } catch(\Exception $e) {
            $this->assertEquals($exception, $e);
        }
    }
}