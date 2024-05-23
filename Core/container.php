<?php

class Container {
    protected $container = [];

    public function bind($key, $function){
        $this->container[$key] = $function;
    }

    public function resolver($key){
        if (!array_key_exists($key, $this->container)){
            throw Exception();
        }

        $function = $this->container[$key];

        call_user_func($function);
    }
}