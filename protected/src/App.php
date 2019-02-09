<?php

namespace src;

use Exception;
use src\managers\ModuleManager;
use src\routers\ConsoleRouter;
use src\routers\WebRouter;

class App
{
    private static $config;

    /**
     * App constructor.
     * @param null $config
     * @throws Exception
     */
    public function __construct($config = null)
    {
        if ($config === null)
            throw new Exception('You must pass config into constructor!');

        self::$config = $config;
    }

    public static function config()
    {
        return self::$config;
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        (new ModuleManager())->init();

        if (!isset($_SERVER['REQUEST_URI'])) {
            $router = new Router(new ConsoleRouter());
        } else {
            $router = new Router(new WebRouter());
        }

        $router->process();
    }
}