<?php

namespace src\routers;

use src\RoutingStrategy;
use application\modules\navigation\components\PrettyUrlManager;
use Exception;

class WebRouter implements RoutingStrategy
{
    private static $moduleName = 'site';
    private static $controllerName = 'Index';
    private static $actionName = 'Index';
    private static $actionParams;
    private static $controller;

    /**
     * @throws Exception
     */
    public function execute()
    {
        $actionParams = [];

        $routes = $this->getPrettyUrl($_SERVER['REQUEST_URI']);

        if ($routes[0] === true)
            $actionParams['isPretty'] = 1;

        if (!empty($routes[1])) {
            self::$moduleName = strtolower($routes[1]);
        }

        if (self::$moduleName == 'assets')
            return;

        if (!empty($routes[2])) {
            self::$controllerName = ucfirst($routes[2]);
        }

        if (strpos(self::$controllerName, '.') !== false)
            return;

        if (!empty($routes[3])) {

            if (strpos($routes[3], '=')) {
                $routes[4] = $routes[3];
                $routes[3] = 'index';
            }

            self::$actionName = ucfirst($routes[3]);
        }

        if (!empty($routes[4])) {
            $params = explode('&', $routes[4]);

            foreach ($params as $param) {
                $tmp = explode('=', $param);
                $actionParams[$tmp[0]] = isset($tmp[1]) ? $tmp[1] : null;
            }
            self::$actionParams = $actionParams;
        }

        $controllerName = self::$controllerName . 'Controller';
        $actionName = 'action' . self::$actionName;
        $namespaceController = 'application\\modules\\' . self::$moduleName . '\\controllers\\' . $controllerName;

        if (!class_exists($namespaceController))
            throw new Exception(__CLASS__ . ': ' . 'No such class &laquo;' . $namespaceController . '&raquo;');

        $controller = new $namespaceController;

        $action = $actionName;

        if (method_exists($controller, $action)) {

            $controller->$action($actionParams);

        } else throw new Exception(__CLASS__ . ': ' . 'No such controller action &laquo;' . $action . '&raquo;');

    }

    /**
     * @param $url
     * @return array|mixed
     */
    private function getPrettyUrl($url)
    {
        return PrettyUrlManager::convert($url);
    }

    /**
     * @return string
     */
    public static function getCurrentModuleName()
    {
        return self::$moduleName;
    }

    /**
     * @return string
     */
    public static function getCurrentControllerName()
    {
        return strtolower(self::$controllerName);
    }

    /**
     * @return string
     */
    public static function getCurrentActionName()
    {
        return strtolower(self::$actionName);
    }

    /**
     * @return mixed
     */
    public static function getCurrentController()
    {
        return self::$controller;
    }

    /**
     * @return mixed
     */
    public static function getActionParams()
    {
        return self::$actionParams;
    }
}
