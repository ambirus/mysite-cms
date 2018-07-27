<?php
namespace src\rest;

class RequestManager
{
    private static $_class = 'FileGet';

    public static function model()
    {
        $class = __NAMESPACE__ . '\\' .self::$_class;
        return new $class;
    }
}