<?php
namespace application\modules\admin\models\users;

class Identity
{
    public static function get()
    {
        return $_SESSION['user'];
    }
}