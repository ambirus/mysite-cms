<?php

namespace application\helpers;

use src\managers\ModuleManager;

class ModuleHelper
{
    public static function get()
    {
        $items = [];
        $modules = ModuleManager::get();

        foreach ($modules as $alias => $module) {
            if ($module->config()['state'] == 1 && isset($module->config()['itemable']) && $module->config()['itemable'] == 1) {
                $k = 'application\\modules\\' . $alias . '\\models\\' . ucfirst($alias);
                $items[$k]['alias'] = $alias;
                $items[$k]['name'] = $module->config()['name'];
            }
        }

        return $items;
    }
}