<?php

namespace src;

use src\routers\WebRouter;

class Url
{
    /**
     * @param $to
     */
    public static function redirect($to)
    {
        header('HTTP/1.1 200 OK');
        header('Location: ' . $to);
    }

    /**
     * @return mixed
     */
    public static function current()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @param $param
     * @return string
     */
    public static function replacePageParam($param)
    {
        $actionParams = WebRouter::getActionParams();

        if ($actionParams == null || sizeof($actionParams) == 1 && isset($actionParams['page']))
            return preg_replace('/\/page=(\d+)/', '', self::current()) . '/page=' . $param;

        if (isset($actionParams['isPretty']))
            return preg_replace('/\/page=(\d+)/', '', self::current()) . '/page=' . $param;
        else return preg_replace('/&page=(\d+)/', '', self::current()) . '&page=' . $param;
    }
}