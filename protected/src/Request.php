<?php

namespace src;

class Request
{
    public static function get($param = null)
    {
        if (sizeof($_GET) > 0) {
            if (!is_null($param) && isset($_GET[$param]))
                return $_GET[$param];
            return $_GET;
        }

        return null;
    }

    public static function post($param = null)
    {
        if (sizeof($_POST) > 0) {
            if (!is_null($param) && isset($_POST[$param]))
                return $_POST[$param];
            return $_POST;
        }

        return null;
    }

    public static function files($param = null)
    {
        if (sizeof($_FILES) > 0) {
            if (!is_null($param) && isset($_FILES[$param]))
                return $_FILES[$param];
            return $_FILES;
        }

        return null;
    }
}