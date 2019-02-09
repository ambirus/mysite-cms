<?php

namespace src\routers;

use src\App;
use src\managers\ModuleManager;
use src\RoutingStrategy;
use Exception;

class ConsoleRouter implements RoutingStrategy
{
    /**
     * @throws Exception
     */
    public function execute()
    {
        if (!isset($_SERVER['argv'][1])) {

            $str = 'List of available commands: ' . "\n";

            $modules = ModuleManager::get();

            if (sizeof($modules) > 0) {

                foreach ($modules as $alias => $module) {

                    $commands = $module->getCommands();

                    if (sizeof($commands) > 0) {
                        foreach ($commands as $command) {
                            $className = 'application\\modules\\' . $alias . '\\commands\\' . ucfirst($command) . 'Command';

                            if (!class_exists($className))
                                throw new Exception(__CLASS__ . ': No such command ' . $className);

                            $methods = get_class_methods($className);
                            if (sizeof($methods) > 0) {
                                foreach ($methods as $method) {
                                    if (substr($method, 0, 6) == 'action') {
                                        $str .= $alias . '/' . $command;

                                        if ($method != 'actionIndex') {
                                            $str .= '/' . str_replace('action', '', strtolower($method));
                                        }

                                        $str .= "\n";
                                    }
                                }
                            }
                        }
                    }
                }
            }

            echo $str;

            return;
        }

        $moduleName = 'site';
        $controllerName = 'Index';
        $actionName = 'Index';

        $params = [];
        $actionParams = [];

        if ($_SERVER['argc'] > 2) {
            for ($i = 2; $i < $_SERVER['argc']; $i++) {
                $params[] = $_SERVER['argv'][$i];
            }
        }

        $routes = explode('/', $_SERVER['argv'][1]);

        if (!empty($routes[0])) {
            $moduleName = strtolower($routes[0]);
        }

        if (!empty($routes[1])) {
            $controllerName = ucfirst($routes[1]);
        }

        if (!empty($routes[2])) {
            $actionName = ucfirst($routes[2]);
        }

        if (sizeof($params) > 0) {
            foreach ($params as $param) {
                $tmp = explode('=', $param);
                $actionParams[$tmp[0]] = isset($tmp[1]) ? $tmp[1] : null;
            }
        }

        $controllerName = $controllerName . 'Command';
        $actionName = 'action' . $actionName;
        $namespaceController = 'application\\modules\\' . $moduleName . '\\commands\\' . $controllerName;

        if (!class_exists($namespaceController))
            throw new Exception(__CLASS__ . ': ' . 'No such class ' . $namespaceController . "\n");

        $controller = new $namespaceController;

        $action = $actionName;

        if (method_exists($controller, $action)) {

            $controller->$action($actionParams);

        } else throw new Exception(__CLASS__ . ': ' . 'No such controller action ' . $action . "\n");
    }
}
