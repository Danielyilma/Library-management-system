<?php

namespace Core\Container;

class Container {
    protected static $container = [];

    public static function bind($key, $function){
        self::$container[$key] = $function;
    }

    public static function resolver($key){
        if (!array_key_exists($key, self::$container)){
            throw Exception();
        }

        $function = self::$container[$key];

        return call_user_func($function);
    }
}