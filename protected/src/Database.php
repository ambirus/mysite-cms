<?php
namespace src;

use ErrorException;

class Database
{
    private static $_instance = null;

    private function __construct() {}

    private function __clone() {}

    private function __wakeup() {}

    public static function getInstance()
    {        

        if (self::$_instance === null) {

            $config = App::config();

            if (!isset($config['db']))
                throw new ErrorException('DB config is absent!');

            $className = 'src\\db\\Mysql';

            if (class_exists($className) === false)
                throw new ErrorException('DB driver is absent!');

            self::$_instance = new $className($config['db']);
        }

        return self::$_instance->get();
    }
}
