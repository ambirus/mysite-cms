<?php

namespace src;

use Exception;

class Database
{
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public static function getInstance()
    {

        if (self::$instance === null) {

            $config = App::config();

            if (!isset($config['db'])) {
                throw new Exception('DB config is absent!');
            }

            $className = 'src\\db\\Mysql';

            if (class_exists($className) === false) {
                throw new Exception('DB driver is absent!');
            }

            self::$instance = new $className($config['db']);
        }

        return self::$instance->get();
    }
}