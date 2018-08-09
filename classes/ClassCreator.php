<?php
namespace classes;

class ClassCreator
{
    public static function includeClass($classPath)
    {
        require_once(str_replace('\\', '/', $classPath) . '.php');
        $classPath = '\\' . $classPath;
        $class = new $classPath;

        return $class;
    }
}
