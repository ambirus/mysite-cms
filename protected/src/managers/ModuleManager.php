<?php

namespace src\managers;

use src\App;
use Exception;

class ModuleManager
{
    private static $modules;

    /**
     * @throws Exception
     */
    public static function init()
    {
        $path = App::config()['modulesPath'];

        if ($path === null) {
            throw new Exception('Config file is empty!');
        }

        $items = scandir($path);

        foreach ($items as $item) {
            if (!in_array($item, ['.', '..']) && is_dir($path . DIRECTORY_SEPARATOR . $item)) {
                $className = 'application\\modules\\' . $item . '\\' . ucfirst($item) . 'Module';
                if (!class_exists($className)) {
                    throw new Exception('No such class &laquo;' . $className . '&raquo; module!');
                }
                self::$modules[$item] = new $className;
            }
        }
    }

    /**
     * @param null $alias
     * @return mixed
     */
    public static function get($alias = null)
    {
        return $alias !== null && isset(self::$modules[$alias]) ? self::$modules[$alias] : self::$modules;
    }

    /**
     * @return array
     */
    public static function getNonSystem()
    {
        $modules = [];

        foreach (self::$modules as $alias => $module) {
            $config = $module->config();

            if (!isset($config['disabled'])) {
                $modules[$alias] = $module;
            }
        }

        return $modules;
    }
}