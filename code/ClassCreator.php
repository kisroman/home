<?php

class ClassCreator
{
    public static function get($className)
    {
        require_once(str_replace('\\', '/', $className) . '.php');
        $className = '\\' . $className;
        $class = new $className;

        return $class;
    }
}
