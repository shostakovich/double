<?php
namespace Double;

class StubbedException {
    protected $exception;

    public function __construct(\Exception $exception) {
        $this->exception = $exception;
    }

    public function throwNow(){
        throw $this->exception;
    }
}