<?php

namespace Double;

class Stub {
    protected $name;
    protected $methods;

    public function __construct($name, $methods = [])
    {
        $this->name = $name;
        $this->methods = $methods;
    }

    public function __call($method_name, $args) {
        $this->ensureMethodExists($method_name);

        $value = $this->methods[$method_name];

        if($value instanceof StubbedException) {
            $value->throwNow();
        }

        return $this->methods[$method_name];
    }

    /**
     * @param $method_name
     * @throws MethodNotFoundException
     */
    protected function ensureMethodExists($method_name)
    {
        if (!array_key_exists($method_name, $this->methods)) {
            throw new MethodNotFoundException("{$this->name}::{$method_name} missing");
        }
    }

    public static function throws($exception) {
        return new StubbedException($exception);
    }
}