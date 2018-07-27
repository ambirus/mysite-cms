<?php

namespace src\routers;

use src\RoutingStrategy;
use application\modules\navigation\components\PrettyUrlManager;
use Exception;

class WebRouter implements RoutingStrategy
{
    private static $_moduleName = 'site';
    private static $_controllerName = 'Index';
    private static $_actionName = 'Index';
    private static $_actionParams;
    private static $_controller;

    public function execute()
    {
        $actionParams = [];

        $routes = $this->_getPrettyUrl($_SERVER['REQUEST_URI']);

        if ($routes[0] === true)
            $actionParams['isPretty'] = 1;

        if (!empty($routes[1])) {
            self::$_moduleName = strtolower($routes[1]);
        }

        if (self::$_moduleName == 'assets')
            return;

        if (!empty($routes[2])) {
            self::$_controllerName = ucfirst($routes[2]);
        }

        if (strpos(self::$_controllerName, '.') !== false)
            return;

        if (!empty($routes[3]))	{

            if (strpos($routes[3], '=')) {
                $routes[4] = $routes[3];
                $routes[3] = 'index';
            }

            self::$_actionName = ucfirst($routes[3]);
        }

        if (!empty($routes[4]))	{
            $params = explode('&', $routes[4]);

            foreach ($params as $param) {
                $tmp = explode('=', $param);
                $actionParams[$tmp[0]] = isset($tmp[1]) ? $tmp[1] : null;
            }
            self::$_actionParams = $actionParams;
        }

        $controllerName = self::$_controllerName . 'Controller';
        $actionName = 'action' . self::$_actionName;
        $namespaceController = 'application\\modules\\' . self::$_moduleName . '\\controllers\\' . $controllerName;

        if (!class_exists($namespaceController))
            throw new Exception(__CLASS__ .': ' . 'No such class &laquo;' . $namespaceController . '&raquo;');

        $controller = new $namespaceController;

        $action = $actionName;

        if (method_exists($controller, $action)) {

            $controller->$action($actionParams);

        } else throw new Exception(__CLASS__ .': ' . 'No such controller action &laquo;' .$action. '&raquo;');

    }

    private function _getPrettyUrl($url)
    {
        return PrettyUrlManager::convert($url);
    }

    public static function getCurrentModuleName()
    {
        return self::$_moduleName;
    }

    public static function getCurrentControllerName()
    {
        return strtolower(self::$_controllerName);
    }

    public static function getCurrentActionName()
    {
        return strtolower(self::$_actionName);
    }

    public static function getCurrentController()
    {
        return self::$_controller;
    }

    public static function getActionParams()
    {
        return self::$_actionParams;
    }
}
