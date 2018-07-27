<?php
namespace src\managers;

use src\App;
use ErrorException;

class ModuleManager
{
    private static $_modules;

    public static function init()
    {
        $path = App::config()['modulesPath'];
        if ($path === null)
            throw new ErrorException('Config file is empty!');

        $items = scandir($path);

        foreach ($items as $item) {
            if (!in_array($item, ['.', '..']) && is_dir($path . DIRECTORY_SEPARATOR .$item)) {

                $className = 'application\\modules\\' . $item . '\\' . ucfirst($item) . 'Module';

                if (!class_exists($className))
                    throw new ErrorException('No such class &laquo;' . $className . '&raquo; module!');

                self::$_modules[$item] = new $className;

            }
        }
    }

    public static function get($alias = null)
    {
        return $alias !== null && isset(self::$_modules[$alias]) ? self::$_modules[$alias] : self::$_modules;
    }

    public static function getNonSystem()
    {
        $modules = [];

        foreach (self::$_modules as $alias => $module) {
            $config = $module->config();

            if (!isset($config['disabled'])) {
                $modules[$alias] = $module;
            }
        }

        return $modules;
    }
}