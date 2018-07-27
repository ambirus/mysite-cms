<?php

namespace application\modules\navigation\components;

use application\modules\navigation\models\PrettyUrl;

class PrettyUrlManager
{
    public static function convert($route)
    {
        $routes = require (__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . 'routes.php');

        if (isset($routes[$route]))
            return explode('/', $routes[$route]);


        preg_match('/\/page=(\d+)/', $_SERVER['REQUEST_URI'], $match);

        $route = preg_replace('/\/page=(\d+)/', '', $_SERVER['REQUEST_URI']);

        $url = (new PrettyUrl())->readBy(['shortUrl' => $route]);

        if (isset($match[0])) {
            $route .= $match[0];
        }

        if ($url['total'] == 0)
            return explode('/', $route);

        $currKey = key($url['items']);
        $routes = explode('/', $url['items'][$currKey]['fullUrl']);

        if (isset($match[0])) {
            $routes[4] = implode('&', [str_replace('/', '', $match[0])]);
        }

        return $routes;
    }
}
