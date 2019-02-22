<?php

class ClassCreator
{
    public static function get($className, $constructorArguments = [])
    {
        require_once(str_replace('\\', '/', $className) . '.php');
        $className = '\\' . $className;
        $class = new $className($constructorArguments);

        return $class;
    }
}
