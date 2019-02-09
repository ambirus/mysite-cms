<?php

namespace src\rest;

class RequestManager
{
    private static $class = 'FileGet';

    /**
     * @return mixed
     */
    public static function model()
    {
        $class = __NAMESPACE__ . '\\' . self::$class;
        return new $class;
    }
}