<?php
namespace application\modules\admin\models\users;

use Exception;

class AuthManager
{
    private static $_manager;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$_manager === null) {

            $userObject = new AuthManagerDb();

            if (!$userObject instanceof Identable)
                throw new Exception(('Класс должен реализовывать интерфейс Identable!'));

            self::$_manager = $userObject;

        }

        return self::$_manager;
    }
}